<?php

class ZenEnv
{

    /**
     * Env path
     * @var mixed
     */
    private $env;

    //private $autosave;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->env = $path;
        //$this->autosave = $autosaveFlag;
        $this->data = [];
    }

    /**
     * Converting env data to array
     * 
     * @param $file
     * @return mixed
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
     * Get env contents
     * 
     * @return mixed
     */
    private function getContent()
    {

        if (is_writable($this->env)) {
            return $this->envToArray($this->env);
        } else {
            echo "File not writable";
            return false;
        }

        //return $this->envToArray($this->env);

    }

    /**
     * Change env values by variables file
     * 
     * @param array $data
     * @return mixed
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
     * Save env contents
     * 
     * @param $array
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
     * Get envs to array
     * 
     * @return array
     */
    public function get()
    {

        return $this->getContent();

    }

    /**
     * Add key/value to env
     * 
     * @param array $data
     * @return mixed
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
     * Delete key/value by keys array
     * 
     * @param array $data
     * @return mixed
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
