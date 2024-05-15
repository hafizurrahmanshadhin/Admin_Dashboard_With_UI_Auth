<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DynamicPageController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = DynamicPage::latest();
            if (!empty($request->input('search.value'))) {
                $searchTerm = $request->input('search.value');
                $data->where('page_title', 'LIKE', "%$searchTerm%");
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('page_content', function ($data) {
                    $page_content       = $data->page_content;
                    $short_page_content = strlen($page_content) > 100 ? substr($page_content, 0, 100) . '...' : $page_content;
                    return '<p>' . $short_page_content . '</p>';
                })
                ->addColumn('status', function ($data) {
                    $status = ' <div class="form-check form-switch">';
                    $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= "checked";
                    }
                    $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' . route('dynamic_page.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div>';
                })
                ->rawColumns(['page_content', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.settings.dynamic_page.index');
    }

    public function create() {
        if (User::find(auth()->user()->id)->hasPermissionTo('dynamic_page')) {
            return view('backend.layouts.settings.dynamic_page.create');
        }
    }

    public function store(Request $request) {
        try {
            if (User::find(auth()->user()->id)->hasPermissionTo('dynamic_page')) {
                $validator = Validator::make($request->all(), [
                    'page_title'   => 'required|string',
                    'page_content' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $data               = new DynamicPage();
                $data->page_title   = $request->page_title;
                $data->page_slug    = Str::slug($request->page_title);
                $data->page_content = $request->page_content;
                $data->save();
            }
            return redirect()->route('dynamic_page.index')->with('t-success', 'Dynamic Page created successfully.');
        } catch (Exception) {
            return redirect()->route('dynamic_page.index')->with('t-error', 'Dynamic Page failed created.');
        }
    }

    public function edit($id) {
        if (User::find(auth()->user()->id)->hasPermissionTo('dynamic_page')) {
            $data = DynamicPage::find($id);
            return view('backend.layouts.settings.dynamic_page.edit', compact('data'));
        }
    }

    public function update(Request $request, $id) {
        try {
            if (User::find(auth()->user()->id)->hasPermissionTo('dynamic_page')) {
                $validator = Validator::make($request->all(), [
                    'page_title'   => 'nullable|string',
                    'page_content' => 'nullable|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $data               = DynamicPage::findOrFail($id);
                $data->page_title   = $request->page_title;
                $data->page_slug    = Str::slug($request->page_title);
                $data->page_content = $request->page_content;
                $data->update();

                return redirect()->route('dynamic_page.index')->with('t-success', 'Dynamic Page Updated Successfully.');
            }
        } catch (Exception) {
            return redirect()->route('dynamic_page.index')->with('t-error', 'Dynamic Page failed to update');
        }
    }

    public function status($id) {
        $data = DynamicPage::where('id', $id)->first();
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        }
    }

    public function destroy($id) {
        $page = DynamicPage::find($id);
        if (!$page) {
            return response()->json(['t-success' => false, 'message' => 'Page not found.']);
        }
        $page->delete();
        return response()->json(['t-success' => true, 'message' => 'Deleted successfully.']);
    }
}
