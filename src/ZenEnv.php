<?php

namespace ZenEnv;



/**
 * Class ZenEnv
 * @package ZenEnv
 */

class ZenEnv
{
    /**
     * @var
     */
    private $env;


    /**
     * @var array
     */
    private $data;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->env = $path;
        $this->data = [];
    }

    /**
     * @param $file
     * @return array
     */

    protected function envToArray($file)
    {
        $string = file_get_contents(trim($file));
        $string = explode("\n", $string);
        $string = array_values(array_filter($string));
        //print_r($string);
        $returnArray = array();
        foreach ($string as $one) {
            $entry = explode("=", $one, 2);
            $returnArray[$entry[0]] = isset($entry[1]) ? $entry[1] : null;
        }

        return $returnArray;
    }

    /**
     * @return array|bool
     * @throws \Exception
     */
    private function getContent()
    {
        if (is_writable($this->env)) {
            return $this->envToArray($this->env);
        } else {
            //echo "File not writable";
            throw new \Exception("Env file not writable!", 1);

            return false;
        }
        //return $this->envToArray($this->env);
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function set($data = array())
    {
        if (count($data) > 0) {
            // $this->createBackup();
            $env = $this->getContent();
            foreach ($data as $dataKey => $dataValue) {
                foreach ($env as $envKey => $envValue) {
                    if ($dataKey === $envKey) {
                        $env[$envKey] = $dataValue;
                    }
                }
            }

            return $this->save($env);
        } else {
            return false;
        }
    }

    /**
     * @param $array
     * @return bool
     */
    protected function save($array)
    {
        if (is_array($array)) {
            $newArray = array();
            $c = 0;
            foreach ($array as $key => $value) {
                $newArray[$c] = $key . "=" . $value;
                $c++;
            }
            $newArray = implode("\n", $newArray);
            file_put_contents($this->env, $newArray);

            return true;
        }

        return false;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        return $this->getContent();
    }


    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function add($data = array())
    {
        if (count($data) > 0) {
            // Create Backup
            //$this->createBackup();
            $env = $this->getContent();
            // Expand the existing array with the new data
            foreach ($data as $key => $value) {
                $env[$key] = $value;
            }

            return $this->save($env);
        }

        return false;
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function delete($data = array())
    {
        //$this->createBackup();
        $env = $this->getContent();
        foreach ($data as $delete) {
            foreach ($env as $key => $value) {
                if ($delete === $key) {
                    unset($env[$key]);
                }
            }
        }

        return $this->save($env);
    }
}
