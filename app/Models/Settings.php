<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $is_header
 * @property int $is_footer
 * @property int $is_logo
 * @property string|null $header_base64
 * @property string|null $footer_base64
 * @property string|null $header_content
 * @property string|null $footer_content
 * @property string|null $logo_base64
 * @property string|null $lab_name
 * @property string|null $kitchen_name
 * @property int|null $print_direct
 * @property string|null $inventory_notification_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereFooterBase64($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereFooterContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereHeaderBase64($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereHeaderContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereInventoryNotificationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereIsFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereIsHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereIsLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereKitchenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereLabName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereLogoBase64($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePrintDirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @property string $authorized_phones
 * @property string $token
 * @property string $instance
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereAuthorizedPhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereInstance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereToken($value)
 * @property string $address
 * @property string $cr
 * @property string $vatin
 * @property string $phone
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereVatin($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{
    protected $guarded = [];
    use HasFactory;
}
