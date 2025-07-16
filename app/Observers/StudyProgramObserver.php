<?php

namespace App\Observers;

use App\Models\StudyProgram;

class StudyProgramObserver
{
    /**
     * Handle the StudyProgram "created" event.
     */
    public function created(StudyProgram $studyProgram): void
    {
        //
    }

    /**
     * Handle the StudyProgram "updated" event.
     */
    public function updated(StudyProgram $studyProgram): void
    {
        //
    }

    /**
     * Handle the StudyProgram "deleted" event.
     */
    public function deleted(StudyProgram $studyProgram): void
    {
        //
    }

    /**
     * Handle the StudyProgram "restored" event.
     */
    public function restored(StudyProgram $studyProgram): void
    {
        //
    }

    /**
     * Handle the StudyProgram "force deleted" event.
     */
    public function forceDeleted(StudyProgram $studyProgram): void
    {
        //
    }
}
