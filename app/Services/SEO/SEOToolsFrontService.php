<?php

namespace App\Services\SEO;

use Exception;
use App\Models\Enhance\SEOTool;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Database\Eloquent\Model;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class SEOToolsFrontService extends SEOToolsService
{
    /**
     * A model to render its SEO data
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
     * Class constructor
     *
     * @param Model $model
     */
    public function __construct1(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Render SEO tools of the specefied resource
     *
     * @return bool
     */
    public function render() : bool
    {
        if(isset($this->model->seotool)) {

            $this->renderMetaInputs();
            $this->renderOGInputs();
            $this->renderTwitterInputs();

            return true;
        }

        return false;
    }

    public function renderSeoPage(string $page_name)
    {
        $pageRecord = SEOTool::where('page_name', $page_name)->first();

        if($pageRecord) {

            SEOMeta::setTitle($pageRecord->meta_title);
            SEOMeta::setDescription($pageRecord->meta_description);

            OpenGraph::setType($pageRecord->og_type);
            OpenGraph::setTitle($pageRecord->og_title);
            OpenGraph::setUrl($pageRecord->og_url);
            OpenGraph::addImage(asset( 'uploads/' . $pageRecord->og_image));
            OpenGraph::setDescription($pageRecord->og_description);

            TwitterCard::addValue('card', $pageRecord->twitter_card);
            TwitterCard::setTitle($pageRecord->twitter_title);
            TwitterCard::setSite($pageRecord->twitter_site);
            TwitterCard::setDescription($pageRecord->twitter_description);
            TwitterCard::addValue('image', asset( 'uploads/' . $pageRecord->twitter_image));
            TwitterCard::addValue('image:alt', $pageRecord->twitter_image_alt);

        }


    }

    /**
     * Start Meta title and description rendering
     *
     * @return void
     */
    private function renderMetaInputs() : void
    {
        SEOMeta::setTitle($this->model->seotool->meta_title);
        SEOMeta::setDescription($this->model->seotool->meta_description);
    }

    /**
     * Start Open Graph Rendering
     *
     * @return void
     */
    private function renderOGInputs() : void
    {
        OpenGraph::setType($this->model->seotool->og_type);
        OpenGraph::setTitle($this->model->seotool->og_title);
        OpenGraph::setUrl($this->model->seotool->og_url);
        OpenGraph::addImage(asset( 'uploads/' . $this->model->seotool->og_image));
        OpenGraph::setDescription($this->model->seotool->og_description);
    }

    /**
     * Start Twitter Card Rendering
     *
     * @return void
     */
    private function renderTwitterInputs() : void
    {
        TwitterCard::addValue('card', $this->model->seotool->twitter_card);
        TwitterCard::setTitle($this->model->seotool->twitter_title);
        TwitterCard::setSite($this->model->seotool->twitter_site);
        TwitterCard::setDescription($this->model->seotool->twitter_description);
        TwitterCard::addValue('image', asset( 'uploads/' . $this->model->seotool->twitter_image));
        TwitterCard::addValue('image:alt', $this->model->seotool->twitter_image_alt);
    }
}
