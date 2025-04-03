<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFunnelPage extends Model {
    use HasFactory;

    protected $fillable = [
        
        'landing_page_id',
        'funnel_title',
        'funnel_content',
        'page_id',
    ];

    protected $casts = [
        'funnel_content' => 'array',
    ];

    public function landingPage()
{
    return $this->belongsTo(LandingPage::class, 'landing_page_id');
}


    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
