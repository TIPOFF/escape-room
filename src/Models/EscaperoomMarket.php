<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Models;

use DrewRoberts\Media\Models\Image;
use Tipoff\Locations\Models\Location;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class EscaperoomMarket extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teamPhoto()
    {
        return $this->belongsTo(Image::class, 'team_image_id');
    }
}
