<?php
namespace App\Utils;
use App\Models\Story;

class SlugValidator
{
    /**
     * @param $title
     * @param int $id
     * @return string
     *
     */
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        return null;
        //throw new \Exception('No pudo generarse el slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Story::select('slug')->where('slug', 'like', $slug.'%')
          //  ->where('id', '<>', $id)
            ->get();
    }
}
