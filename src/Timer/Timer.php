<?php
namespace Timer;


class Timer
{
	/**
	 * All of the stored timers.
	 *
	 * @var array
	 */
	protected $timers = array();
	
	
	public function __construct($startTime = null)
	{
		$this->startTimer('application', $startTime);
	}
	
	/**
	 * Start a timer.
	 */
	public function startTimer($timer, $startTime = null)
	{
		if (is_null($startTime)) {
			$startTime = microtime(true);
		}

		$this->timers[$timer]['start'] = $startTime;

		return $this;
	}
	
	/**
	 * End a timer.
	 */
	public function endTimer($timer, $endTime = null)
	{
		if (is_null($endTime)) {
			$endTime = microtime(true);
		}

		$this->timers[$timer]['end'] = $endTime;

		return $this;
	}

	/**
	 * Get a timer.
	 */
	public function getTimer($timer)
	{
		if (isset($this->timers[$timer]))
		{
			// Turn off the timer if it hasn't been already.
			if (!isset($this->timers[$timer]['end'])) {
				$this->timers[$timer]['end'] = microtime(true);
			}

			$timer = $this->timers[$timer];

			return round(1000 * ($timer['end'] - $timer['start']), 4);
		}
	}

	/**
	 * Get all of the executed timers.
	 *
	 * @return array
	 */
	public function getTimers()
	{
		$timers = array();

		foreach ($this->timers as $timer => $data) {
			$timers[$timer] = $this->getTimer($timer);
		}

		return $timers;
	}

	/**
	 * Get the current application execution time in milliseconds.
	 *
	 * @return int
	 */
	public function getLoadTime()
	{
		return $this->endTimer('application')->getTimer('application');
	}
}
