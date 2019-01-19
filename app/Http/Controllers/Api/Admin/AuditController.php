<?php

namespace EmejiasInventory\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Http\Resources\Admin\AuditResource;
use EmejiasInventory\Entities\Audit;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::dates()->with(['user', 'details.product'])->orderByDesc('id')->paginateIf();
        return AuditResource::collection($audits);
    }

    public function store()
    {

        $audit = Audit::create([
            'commerce_id' => 1,
            'user_id'     => auth('api')->user()->id,
            'status'      => 'Creado'
        ]);

        $audit->auditAllProducts($audit);

        return new AuditResource($audit->load(['user', 'details.product',]));
    }

    public function show(Audit $audit)
    {
        return new AuditResource($audit->load(['user', 'details.product',]));
    }

    public function update(Request $request, Audit $audit)
    {
        $audit->update($request->all());
        return new AuditResource($audit->load(['user', 'details.product',]));
    }
}
