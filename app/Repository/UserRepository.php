<?php


namespace App\Repository;


use App\User;
use Uzzal\Crud\AbstractRepository;
use Illuminate\Support\Facades\DB;
use Uzzal\Acl\Models\Role;
use Uzzal\Acl\Models\UserRole;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    public function update($data, $id)
    {
        $data = $data->all();
        self::assignRoles($id, $data['role_id']);
        return parent::update($data, $id);
    }

    public static function assignRoles($user_id, $roles = [])
    {
        if(count($roles)==0){
            $t = Role::where('name', 'Default')->first();
            if($t){
                $roles = array($t->role_id);
            }
        }

        $curr = extract_roles(UserRole::where('user_id', $user_id)->get());
        $delete = array_diff($curr, $roles);
        $insert = array_diff($roles, $curr);

        $data = [];
        foreach ($insert as $v) {
            $data[] = [
                'user_id' => $user_id,
                'role_id' => $v
            ];
        }

        DB::transaction(function () use ($user_id, $delete, $data) {
            UserRole::where('user_id', $user_id)->whereIn('role_id', $delete)->delete();
            UserRole::bulkInsert($data);
        });
    }
}
