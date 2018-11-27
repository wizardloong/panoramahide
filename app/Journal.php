<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Journal extends Model
{
    use Translatable;

    public $translatable = [
        'name', 'code', 'in_HAC_list', 'image', 'description', 'preview_image', 'preview_description',
        'format', 'volume', 'periodicity', 'editorial_board', 'article_index', 'rubrics', 'review_procedure',
        'article_submission_rules'
    ];
//    protected $fillable = ['code'];

    /**
     * Categories of the journal belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Publish offices of the journal belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function publishings() {
        return $this->belongsToMany(Publishing::class);
    }

    /**
     * Contact of the journal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact() {
        return $this->belongsTo(JournalContact::class, 'journal_contact_id');
    }

    public function releases() {
        $this->hasMany(Release::class);
    }
}