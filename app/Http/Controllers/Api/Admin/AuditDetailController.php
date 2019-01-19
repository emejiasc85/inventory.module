<?php

namespace EmejiasInventory\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\AuditDetail;
use EmejiasInventory\Http\Resources\Admin\AuditDetailResource;

class AuditDetailController extends Controller
{
    public function update(Request $request, AuditDetail $audit_detail)
    {
        $audit_detail->update($request->all());
        return new AuditDetailResource($audit_detail);
    }

    public function destroy(AuditDetail $audit_detail)
    {
        $audit_detail->delete();
        return response([],204);
    }
}
