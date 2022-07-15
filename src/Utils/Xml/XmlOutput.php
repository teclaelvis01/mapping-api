<?php
namespace App\Utils\Xml;


class XmlOutput
{

    public  $data = [];

    private $content = '';

    /**
     * constructor
     * @param  array $data
     *
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getXml(): string
    {
        $this->content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $this->content .= $this->converter($this->data);
        return $this->content;
    }
    // conver xmlStr format to string plain text
    static public function getPlainText($xmlStr): string
    {
        // xmlStr remove all empty lines
        $xmlStr = preg_replace('/\s+/', '', $xmlStr);
        $xmlStr = preg_replace('/\n+/', '', $xmlStr);
        
        return $xmlStr;
    }




    /**
     * @param $array
     *
     * @return bool
     */
    private function isAssoc($array): bool
    {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }



    /**
     * @param $node
     * @param int  $level
     *
     * @return string
     */
    private function converter($node, int $level = 0): string
    {
        $xml = '';
        $attributes = '';
        $indent = str_repeat('    ', $level);

        // handle attributes
        if (count($node) > 1) {
            foreach ($node as $key => $value) {
                
                if ($key[0] !== '@') {
                    continue;
                }
                
                $attributes .= ' ' . substr($key, 1);
                
                
                if (!is_bool($value)) {
                    $attributes .= '="' . $value . '"';
                }

                unset($node[$key]);
            }
        }

        foreach ($node as $tag => $data) {
            switch (gettype($data)) {
                case 'array':
                    $xml .= "{$indent}<{$tag}{$attributes}>\n";

                    if ($this->isAssoc($data)) {
                        $xml .= $this->converter($data, $level + 1);
                    } else {
                        foreach ($data as $child) {
                            $xml .= $this->converter($child, $level + 1);
                        }
                    }

                    $xml .= "{$indent}</{$tag}>\n";

                    break;

                case 'NULL':
                    $xml .= "{$indent}<{$tag}{$attributes} />\n";

                    break;

                default:
                    $data = htmlspecialchars($data, ENT_XML1);
                    $xml  .= "{$indent}<{$tag}{$attributes}>{$data}</{$tag}>\n";

                    break;
            }
        }

        return $xml;
    }

}
