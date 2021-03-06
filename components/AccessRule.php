<?php

namespace app\components;

use yii\filters\AccessRule as AccessRuleBase;

class AccessRule extends AccessRuleBase
{

    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            switch($role){
                case '?':
                    if ($user->getIsGuest()) {
                        return true;
                    }
                    break;
                case '@':
                    if (!$user->getIsGuest()) {
                        return true;
                    }
                    break;
                default:
                    if (!$user->getIsGuest() && $role == $user->identity->type) {
                        return true;
                    }
                    break;
            }
        }
        return false;
    }
}