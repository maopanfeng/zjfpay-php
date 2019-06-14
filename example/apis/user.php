<?php
require __DIR__.'/../deals/UserDeal.php';

class UserCtr
{
    protected $member;
    
    public function __construct()
    {
        $this->member = new \zjf\pay\apis\user\User();
    }
    
    public function create($data = [])
    {
        try {
            $result = $this->member->create($data);
            Log::info($data, $result);
            UserDeal::create($result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function query($data = [])
    {
        try {
            $result = $this->member->query($data);
            Log::info($data, $result);
            UserDeal::create($result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function lists($data = [])
    {
        try {
            $result = $this->member->lists($data);
            Log::info($data, $result);
            UserDeal::create($result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function update($data = [])
    {
        try {
            $result = $this->member->update($data);
            Log::info($data, $result);
            UserDeal::create($result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function delete($data = [])
    {
        try {
            $result = $this->member->delete($data);
            Log::info($data, $result);
            UserDeal::create($result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
}