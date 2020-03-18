<?php

trait AuditTrait
{
    public function behaviors()
    {

    }

    public function afterSave()
    {
        $audit = new AuditLog($this);
        return $audit->save();
    }
}