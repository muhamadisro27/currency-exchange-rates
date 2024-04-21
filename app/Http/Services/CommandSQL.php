<?php 

namespace App\Http\Services;

use App\Helper\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class CommandSQL {

    public function __construct(protected Str $str)
    {
    }

    public function updateOrCreate($data, $model, $name)
    {
        try {
            DB::beginTransaction();

            switch ($name) {
                case 'User':
                    if(isset($model->id)) {
                        $model->roles()->detach();

                        foreach($model->getAllPermissions()->pluck('name')->toArray() as $removePermission) {
                            $model->revokePermissionTo($removePermission);
                        }

                        $role = Role::where('name', $data['role'])->first();
                        $model->syncRoles($role->name);
                        $model->syncPermissions($role->permissions);
                    }
                    $model->updateOrCreate([
                        'uuid' => $model['uuid'] ?? Uuid::uuid1(),
                    ], $data);

                    break;

                default:
                    $model->updateOrCreate([
                        'uuid' => $model['uuid'] ?? Uuid::uuid1(),
                    ], $data);
                    break;
            }

            DB::commit();

            $response = $this->str->initial_response($name . ' has been successfully ' . (!isset($model->id) ? 'created' : 'updated'));
        } catch (\Throwable $th) {

            DB::rollBack();

            $response = $this->str->initial_response($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    public function destroy($name, $model)
    {
        try {
            DB::beginTransaction();

            $model->delete();

            DB::commit();

            $response = $this->str->initial_response($name . ' has been successfully deleted');
        } catch (\Throwable $th) {

            DB::rollBack();

            $response = $this->str->initial_response($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}

?>