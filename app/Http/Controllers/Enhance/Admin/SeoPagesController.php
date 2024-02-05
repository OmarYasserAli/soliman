<?php

namespace App\Http\Controllers\Enhance\Admin;

use Illuminate\Http\Request;
use App\Models\Enhance\SEOTool;
use App\Http\Controllers\Controller;
use App\Services\SEO\SEOToolsService;

class SeoPagesController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page_name)
    {
        $result = SEOTool::where('page_name', $page_name)->firstOrFail();

        return view('enhance.admin.seopages', compact('result', 'page_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page_name, SEOToolsService $seoToolsService)
    {
        $request->validate($seoToolsService->getSEOToolsValidationRules());

        $pageRecord = SEOTool::where('page_name', $page_name)->firstOrFail();

        $seoToolsService->updatePageSeo($request, $page_name, $pageRecord);

        return redirect()->route('admin.seo-pages.edit', $page_name);
    }
}
