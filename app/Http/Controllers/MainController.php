<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Yadakhov\Tor;

class MainController extends Controller
{
    /**
     * Front page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function frontpage(Request $request)
    {
        $url = $request->input('url');

        if (empty($url)) {
            return view('frontpage', ['url' => 'https://ipnumber.info']);
        }

        if (starts_with($url, '//')) {
            $url = 'https:'.$url;
        }

        // add http in url is doesn't exist
        if (!starts_with($url, ['http://', 'https://'])) {
            $url = 'http://'.$url;
        }

        // Don't use Tor if the url is in the white list
        if ($this->isWhiteListUrl($url)) {
            $content = file_get_contents($url);
            return response($content);
        }

        $tor = new Tor();
        $tor->newIp();

        list($content, $ch) = $tor->curl($url);

        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

        if (empty($contentType)) {
            $contentType = 'text/html';
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        unset($ch);

        if (empty($statusCode)) {
            $statusCode = '200';
        }

        if (strpos($contentType, 'html') !== false) {
            $this->injectTorelayUrl($url, $content);
        }

        return response($content, $statusCode, ['Content-Type' => $contentType]);
    }

    /**
     * Return true if the url is a white listed
     */
    private function isWhiteListUrl($url)
    {
        // store url as the key in the array to take advantage of the hashmap O(1) lookup
        $whiteList = [
            'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' => true,
            'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js' => true,
            'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js' => true,
            'http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js' => true,
            'http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css' => true,
            'http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js' => true,
            'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' => true,
            'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js' => true,
            'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js' => true,
            'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js' => true,
            'https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css' => true,
            'https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js' => true,
            'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/readable/bootstrap.min.css' => true,
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js' => true,
        ];

        return isset($whiteList['url']);
    }

    /**
     * Inject torelay url
     * <a href="http://example.com"> will become <a href="https://torelay.comm?url=http://example.com">
     *
     * @param $url
     * @param $content
     */
    private function injectTorelayUrl($url, &$content)
    {
        $torGetUrl = env('APP_URL').'?url=';
        $parseUrl = parse_url($url);;
        $domainUrl = $parseUrl['scheme'].'://'.$parseUrl['host'];
        $path = isset($parseUrl['path']) ? $parseUrl['path'] : '';
        $domainUrlPath = $parseUrl['scheme'].'://'.$parseUrl['host'].$path;

        // inject torelay http
        $content = str_replace(
            [
                'href="http',
                "href='http",
                'href="//',
                "href='//",
                'src="http',
                "src='http",
                'src="//',
                "src='//",

                'href="/',
                "href='/",
                'src="/',
                "src='/",
                'action="/',
                "action='/",

                'href="./',
                "href='./",
                'src="./',
                "src='./",
            ],
            [
                'href="'.$torGetUrl.'http',
                "href='".$torGetUrl.'http',
                'href="'.$torGetUrl.'//',
                "href='".$torGetUrl.'//',
                'src="'.$torGetUrl.'http',
                "src='".$torGetUrl.'http',
                'src="'.$torGetUrl.'https://',
                "src='".$torGetUrl.'https//',

                'href="'.$torGetUrl.$domainUrl.'/',
                "href='".$torGetUrl.$domainUrl.'/',
                'src="'.$torGetUrl.$domainUrl.'/',
                "src='".$torGetUrl.$domainUrl.'/',
                'action="'.$torGetUrl.$domainUrl.'/',
                "action='".$torGetUrl.$domainUrl.'/',

                'href="'.$torGetUrl.$domainUrlPath,
                "href='".$torGetUrl.$domainUrlPath,
                'src="'.$torGetUrl.$domainUrlPath,
                "src='".$torGetUrl.$domainUrlPath,
            ],
            $content
        );
    }


    /**
     * The about page
     */
    public function about()
    {
        return view('about');
    }

}
