<?php namespace App;

use mikehaertl\shellcommand\Command;

/**
 * Class Tor to help dealing with tor
 *
 * @package App
 */
class Tor
{
    public function __construct()
    {
        if (!$this->isRunning()) {
            $this->command('start');
        }
        $this->newIp();
    }

    /**
     * Execute tor command
     *
     * @param $command
     * @return Command|string
     */
    public function command($command)
    {
        if (!in_array($command, ['start', 'stop', 'restart', 'reload', 'force-reload', 'status'])) {
            throw new \InvalidArgumentException($command);
        }

        $command = 'sudo /etc/init.d/tor '.$command;
        $command = new Command($command);
        $command->execute();

        return $command;
    }

    /**
     * Start
     *
     * @return Command|string
     */
    public function start()
    {
        $command = $this->command('start');

        return $command;
    }

    /**
     * Stop
     *
     * @return Command|string
     */
    public function stop()
    {
        $command = $this->command('stop');

        return $command;
    }

    /**
     * Restart
     *
     * @return Command|string
     */
    public function restart()
    {
        $command = $this->command('restart');

        return $command;
    }

    /**
     * Reload
     *
     * @return Command|string
     */
    public function reload()
    {
        $command = $this->command('reload');

        return $command;
    }

    /**
     * Force Reload
     * @return Command|string
     */
    public function forceReload()
    {
        $command = $this->command('force-reload');

        return $command;
    }

    /**
     * Status
     * @return Command|string
     */
    public function status()
    {
        $command = $this->command('status');

        return $command;
    }

    /**
     * Return true if tor is running
     *
     * @return bool
     */
    public function isRunning()
    {
        $command = $this->command('status');

        return $command->getOutput() === '* tor is running';
    }

    /**
     * Reload for a new ip number
     *
     * @return bool
     */
    public function newIp()
    {
        $command = $this->command('reload');

        return $command->getExitCode() === 0;
    }

    /**
     * Tor curl wrapper
     * @param $url
     * @return bool|mixed
     */
    public function curl($url)
    {
        $ip = '127.0.0.1';
        $port = '9051';
        $auth = 'PASSWORD';
        $command = 'signal NEWNYM';

        $fp = fsockopen($ip, $port, $error_number, $err_string, 2);
        if (!$fp) {
            echo "ERROR: $error_number : $err_string";

            return false;
        } else {
            fwrite($fp, "AUTHENTICATE \"".$auth."\"\n");
            $received = fread($fp, 512);
            fwrite($fp, $command."\n");
            $received = fread($fp, 512);
        }

        fclose($fp);

        $ch = curl_init();

        $headers = $this->getRandomHeader();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:9050');
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        return [$response, $ch];
    }

    /**
     * Get a radmom header
     *
     * @return array
     */
    public function getRandomHeader()
    {
        $headers = [
            'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/41.0.2272.76 Chrome/41.0.2272.76 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
        ];

        $randomKey = array_rand($headers);

        return [
            $headers[$randomKey]
        ];
    }

}
