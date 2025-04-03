<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model {
    use HasFactory;

    protected $fillable = [
        'page_id',
        'landing_title',
        'landing_content',
    ];

    protected $casts = [
        'landing_content' => 'array',
    ];

    public function salesFunnelPages()
    {
        return $this->hasMany(SalesFunnelPage::class, 'landing_page_id');
    }
}