<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewStored extends Mailable implements ShouldQueue
{
	use Queueable, SerializesModels;

	/**
	 * The review hash.
	 *
	 * @var string
	 */
	protected $hash;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($hash)
	{
		$this->hash = $hash;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->markdown('emails.reviews.stored')->with(['url' => route('review.verify', ['hash' => $this->hash])]);
	}
}
