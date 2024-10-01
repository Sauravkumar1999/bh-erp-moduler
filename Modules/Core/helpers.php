<?php

use Modules\Core\Entities\PageMeta;

if (!function_exists('sanitize_output')) {

    /**
     * Minify html String.
     *
     * @param $buffer
     * @return string
     */
    function sanitize_output($buffer)
    {

        $replace = [
            '/<!--[^\[](.*?)[^\]]-->/s' => '',
            "/<\?php/"                  => '<?php ',
            "/\n([\S])/"                => ' $1',
            "/\r/"                      => '',
            "/\n/"                      => '',
            "/\t/"                      => ' ',
            '/ +/'                      => ' ',
        ];

        return preg_replace(array_keys($replace), array_values($replace), $buffer);
    }
}

if (!function_exists('price_formatter')) {
    /*
     * Function is used to format number
     *
     */
    function price_formatter($number, $decimal = false, $decimal_separator = ".", $thousands_separator = ",")
    {
        return number_format((float)$number, $decimal, $decimal_separator, $thousands_separator);
    }
}
if (!function_exists('get_meta_data')) {
    /*
     * Function is used to show meta data in sales page
     *
     */
    function get_meta_data()
    {
        try {
            $url = request()->url();
            $data = PageMeta::where('page_url', $url)->first();
            $metaTags = '';

            if ($data && count($data->meta_information) > 0 && $data->status) {
                $metadata = $data->meta_information;
                foreach ($metadata as $index => $item) {
                    if (isset($item['property']) && isset($item['content'])) {
                        $metaTags .= '<meta property="' . htmlspecialchars($item['property']) . '" content="' . htmlspecialchars($item['content']) . '">' . PHP_EOL;
                    }
                }
            }
            return $metaTags;
        } catch (\Exception $e) {
            return '';
        }
    }
}


if (!function_exists('isSecure')) {

    function isSecure()
    {
        $isSecure = false;
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $isSecure = true;
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
            $isSecure = true;
        }

        return $isSecure;
    }

}
