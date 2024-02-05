<?php

namespace App\Services;

use Exception;
use App\Models\Enhance\Script;
use Illuminate\Database\Eloquent\Model;


class ScriptsService
{
    /**
     * List of scripts form input names and validations
     */
    protected $scriptsInputs = [

        'head_script'   => 'nullable|string',
        'footer_script' => 'nullable|string',
    ];

    /**
     * A model to attach the record of scripts to it
     */
    private $model;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        $constructor = method_exists( $this, $fn = "__construct" . $numberOfArguments );

        if ($numberOfArguments == 0) {
            call_user_func_array([$this, '__emptyConstruct'], $arguments);
        } elseif($constructor) {
            call_user_func_array([$this, $fn], $arguments);
        } else {
            throw new Exception("No matching constructor found" . PHP_EOL);
        }
    }

    /**
     * Class empty constructor
     */
    private function __emptyConstruct() { }

    /**
     * Class constructor 1
     * Multiple constructor with only request restriction
     *
     * @param Illuminate\Database\Eloquent\Model $model
     */
    private function __construct1(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the entire process for storing or updating scripts
     *
     * @return void
     */
    public function execute()
    {
        if($this->anyScriptsInputIsFilled()) $this->handleScriptRecord();
    }

    /**
     * Delete related script
     *
     * @return void
     */
    public function destroy() : void
    {

        if($this->model->script) Script::destroy($this->model->script->id);
    }

    /**
     * A getter for scripts validation rules
     *
     * @return array
     */
    public function getScriptsValidationRules() : array
    {
        return $this->scriptsInputs;
    }

    /**
     * Create or update the record for scripts table attached with its relevant model.
     *
     * @return void
     */
    private function handleScriptRecord() : void
    {
        $seoToolRecord = Script::updateOrCreate(
            ['scriptable_id' => $this->model->id, 'scriptable_type' => get_class($this->model)],
            $this->getOnlyScriptsFields(),
        );

        $this->model->script()->save($seoToolRecord);
    }

    /**
     * Check if any input from scripts type is sent and filled in the request
     *
     * @return bool A flag to determine if any input from scripts type is filled or not
     */
    private function anyScriptsInputIsFilled() : bool
    {
        $isFilled = false;

        foreach(array_keys($this->scriptsInputs) as $scriptInputKey) {
            if(request()->has($scriptInputKey)) {
                $isFilled = true;
                break;
            }
        }

        return $isFilled;
    }

    /**
     * Get only the scripts inputs keys and values from the request data
     *
     * @return array
     */
    private function getOnlyScriptsFields() : array
    {
        $data = [];

        foreach(array_keys($this->scriptsInputs) as $key) {
            if(request()->has($key)) $data[$key] = request()->input($key);
        }

        return $data;
    }
}
