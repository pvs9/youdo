<?php

namespace App\Mail;

use App\Resume;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResumeStored extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

	/**
	 * The resume instance.
	 *
	 * @var Resume
	 */
	protected $resume;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.resumes.stored')->with(['id' => $this->resume->id]);
    }
}
