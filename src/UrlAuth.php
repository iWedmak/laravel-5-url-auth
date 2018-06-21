<?php namespace iWedmak\UrlAuth;

use Illuminate\Database\Eloquent\Model;

class UrlAuth extends Model
{

	protected $softDelete = true;
    protected $table;
    protected $guarded=array();

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = \Config::get('urlauth.table');
        
    }
    
    public static function boot()
    {
        parent::boot();
        
        self::creating(function($model)
        {
            $model->token=substr(bin2hex(random_bytes(254)), 0, 254);
            $model->lifetime=\Carbon\Carbon::now()->addHours(\Config::get('urlauth.lifetime'));
        });
    }
    
    public function user()
    {
        return $this->belongsTo(\Config::get('urlauth.user_model'));
    }
    
}