<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tor;

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
            return view('main.frontpage', ['url' => 'http://whatismyip.org']);
        }

        if (starts_with($url, '//')) {
            $url = 'https:'.$url;
        }

        // add http in url is doesn't exist
        if (!starts_with($url, ['http://', 'https://'])) {
            $url = 'http://'.$url;
        }

        $tor = new Tor();
        list($content, $ch) = $tor->curl($url);

        // store current $url
        session('url', $url);

        $parseUrl = parse_url($url);;
        $domainUrl = $parseUrl['scheme'].'://'.$parseUrl['host'];
        $path = isset($parseUrl['path']) ? $parseUrl['path'] : '';
        $domainUrlPath = $parseUrl['scheme'].'://'.$parseUrl['host'].$path;

        // for injecting src and href
        $torGetUrl = env('APP_URL').'?url=';

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

            $analytics = view('_includes.analytics')->render().'</html>';
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

                    'href="./',
                    "href='./",
                    'src="./',
                    "src='./",

                    '</html>',
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

                    'href="'.$torGetUrl.$domainUrlPath,
                    "href='".$torGetUrl.$domainUrlPath,
                    'src="'.$torGetUrl.$domainUrlPath,
                    "src='".$torGetUrl.$domainUrlPath,

                    $analytics
                ],
                $content
            );
        }

        return response($content, $statusCode, ['Content-Type' => $contentType]);
    }

    /**
     * The about page
     */
    public function about()
    {
        return view('main.about');
    }

}
