<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TranslatableService
{
    /**
     * Dynamically handle generating the translatable process
     *
     * @param array $columns The required translatable model fields
     * @param array $validatedData The only request validated data
     * @return array
     */
    public static function generateTranslatableFields(array $columns, array $validatedData): array
    {
        $fields = [];

        foreach ($columns as $column) {
            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
                $fields[$column][$lang] = $validatedData[$column . '_' . $lang];
            }
        }

        return $fields;
    }

    /**
     * Dynamically get translatable fields
     *
     * @param array $columns
     * @param Class $record
     * @return array
     */
    public static function getTranslatableInputs($record): array
    {
        $fields = [];

        foreach($record::$translatableColumns as $key => $attribute) {
            foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
                $fields[$key . "_" . $lang] = $attribute;
            }
        }

        return $fields;
    }

    /**
     * Dynamically get translatable fields
     *
     * @param array $columns
     * @param Model $record
     * @return array
     */
    public static function getTranslatableFields(array $columns, Model $record, $withEntireRecordData = true): array
    {
        $fields = [];


        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            foreach ($columns as $column) {
                $fields[$column . "_" . $lang] = $record->getTranslation($column, $lang);
            }
        }

        if ($withEntireRecordData) $fields = array_merge(Arr::except($record->toArray(), $columns), $fields);

        return $fields;
    }

    /**
     * Retrieve all non-translatable fileds for the specified resource
     *
     * @param Model $record
     * @param array $validatedData
     * @return array
     */
    public static function getNonTranslatableFields(Model $record, array $validatedData): array
    {
        $filesData = self::handleFilesColumns($record->filesFields ?? [], $validatedData, $record->filesPath);

        $exceptedColumns = array_merge(array_keys($filesData), array_keys(self::getTranslatableInputs($record)));

        return array_merge($filesData, Arr::except($validatedData, $exceptedColumns));
    }

    /**
     * Handle storing files to the specified resource
     *
     * @param array $filesFields
     * @param array $validatedData
     * @param string $filesPath
     * @return array
     */
    public static function handleFilesColumns(array $filesFields, array $validatedData, string $filesPath): array
    {
        $filesData = [];

        foreach ($filesFields as $fileName) {
            if (!array_key_exists($fileName, $validatedData)) continue;
            $filesData[$fileName] = FileService::savePublicFile($validatedData[$fileName], $filesPath);
        }

        return $filesData;
    }

    /**
     * Handle storing files to the specified resource
     *
     * @param array  $filesFields
     * @param string $filesPath
     * @param int    $record_id
     * @param string $fieldFileName
     * @param string $fieldRecordName
     * @return array
     */
    public static function handleMultipleFiles(array $files, string $filesPath,int $record_id, string $fieldFileName, string $fieldRecordName): array
    {
        $filesData = [];

        foreach ($files as $file) {
            $filesData[] = [$fieldFileName => FileService::savePublicFile($file, $filesPath), $fieldRecordName => $record_id];
        }

        return $filesData;
    }


    /**
     * Dynamically add translatable columns to table
     *
     * @param Model $model
     * @param DataTables $table A DataTables Collection instance
     * @param Array $except
     * @return void
     */
    public static function addTranslatableColumnsToDataTable(Model $model, $table, array $except = [])
    {
        foreach ((new $model)->translatable as $column) {

            if (in_array($column, $except)) continue;

            $lang = LaravelLocalization::getCurrentLocale();
            $table->editColumn($column, function ($data) use ($lang, $column) {
                return Str::limit($data->getTranslation($column, $lang), '50');
            });
        }
    }

    /**
     * Dynamically generate all translatable fields validation rules
     *
     * @param array $columns
     */
    public static function validateTranslatableFields(array $columns)
    {
        $validationRules = [];

        foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            foreach($columns as $column => $data) {
                $validationRules[$column . '_' . $lang] = $data['validations'];
            }
        }

        return $validationRules;
    }
}
