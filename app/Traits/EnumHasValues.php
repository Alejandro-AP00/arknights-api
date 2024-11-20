<?

namespace App\Traits;

trait EnumHasValues
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
