<?php
function extract_roles($sel)
{
    if ($sel instanceof \Illuminate\Database\Eloquent\Collection) {
        $sel = $sel->toArray();
    }
    return array_column($sel, 'role_id');
}
if (! function_exists('role_names')) {

    /**
     * @param $user_role
     * @return bool|string
     */
    function role_names($user_role)
    {
        $str = '';
        if (!($user_role instanceof \Illuminate\Database\Eloquent\Collection)) {
            return $str;
        }
        foreach ($user_role as $u) {
            if (!$u->role) {
                continue;
            }
            $str .= $u->role->name . ', ';
        }

        return substr($str, 0, -2);
    }

}
function user_role($role){
    $role_name = \Uzzal\Acl\Models\Role::find($role);
    return $role_name->name;
}
function is_role($role)
{
    $roles = \Illuminate\Support\Facades\Auth::user()->userRole;
    if (!is_array($role)) {
        $role = [$role];
    }
    foreach ($roles as $r) {
        if (in_array($r->role->name, $role)) {
            return true;
        }
    }
    return false;
}

function chk_roles($name, $sel = '')
{
    $str = '';

    if ($sel instanceof \Illuminate\Database\Eloquent\Collection) {
        $sel = extract_roles($sel);
    }

    $roles = \Uzzal\Acl\Models\Role::all();
    foreach ($roles as $v) {
        if($v->name==='Developer'){continue;}
        $checked = ($sel && in_array($v->role_id, $sel)) ? 'checked="checked"' : '';
        $str .= '<div class="checkbox"><label><input class="role" name="' . $name . '[]" type="checkbox" 
                value="' . $v->role_id . '" ' . $checked . '>' . $v->name . '</label></div>';
    }

    return $str;
}
