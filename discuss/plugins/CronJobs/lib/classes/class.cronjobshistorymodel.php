<?php if (!defined('APPLICATION')) exit();
/**
${licence}
*/


/**
 * Cron Jobs History Model
 *
 * @package CronPlugin
 */

/**
 * Allows to read/write Cron Jobs History table.
 */
class CronJobsHistoryModel extends Gdn_Model {
	/**
	 * Set Validation Rules that apply when saving a new row in Cron Jobs History.
	 *
	 * @return void
	 */
	protected function _SetCronJobsHistoryValidationRules() {
		// Set additional Validation Rules here. Please note that formal validation
		// is done automatically by base Model Class, by retrieving Schema
		// Information.
	}

	/**
	 * Defines the related database table name.
	 */
	public function __construct() {
		parent::__construct('CronJobsHistory');

		$this->_SetCronJobsHistoryValidationRules();
	}

	/**
	 * Build SQL query to retrieve the History of Cron Jobs executed in a date
	 * range.
	 */
	protected function PrepareCronJobsHistoryQuery() {
		$Px = Gdn::Database()->DatabasePrefix;

		$Query = $this->SQL
			->Select('CJH.CronJobsHistoryID', '', 'CronHistoryID')
			->Select('CJH.ClassName', '', 'ClassName')
			->Select('CJH.StartedAt', '', 'StartedAt')
			->Select('CJH.FinishedAt', '', 'FinishedAt')
			->Select('CJH.Result', '', 'Result')
			->Select('CJH.ResultMessage', '', 'ResultMessage')
			->Select('CJH.DateInserted', '', 'DateInserted')
			->From('CronJobsHistory CJH');

		return $Query;
	}

	/**
	 * Modifies standard Gdn_Model->Get to use CronJobsHistoryQuery.
	 *
	 * Events: BeforeGet, AfterGet.
	 *
	 * @param $DateFrom Beginning of the period to include in the result. Date
	 * must be passed as a string in ISO8601 Format (e.g. '2012-03-01')'
	 * @param $DateTo End of the period to include in the result. It follows the
	 * same format rules as parameter $DateFrom.
	 *
	 * @return A DataSet containing the Cron Job History for the specified period,
	 * or FALSE if an error occurred while retrieving it.
	 *
	 * @see http://en.wikipedia.org/wiki/ISO_8601
	 */
	public function Get($DateFrom, $DateTo) {
		$this->FireEvent('BeforeGet');

		// On day is added to DateTo as the date it represents should be included
		// until 23:59:59.000. By adding one day and querying by "< DateTo", we're
		// sure to get all the data.
		$DateTo = date('Y-m-d', strtotime($DateTo . ' +1 day'));

		// Return the Jobs Started within the Date Range.
		$this->PrepareCronJobsHistoryQuery();
		$Result = $this->SQL
			->Where('StartedAt >=', "DATE('$DateFrom')", TRUE, FALSE)
			->Where('FinishedAt <', "DATE('$DateTo')", TRUE, FALSE)
			->OrderBy('StartedAt', 'desc')
			->Get();

		$this->EventArguments['Data'] = &$Result;
		$this->FireEvent('AfterGet');

		return $Result;
	}

	/**
	 * Retrieves Cron Jobs History for a specified Year and Month.
	 *
	 * @param Year The year used to filter the results.
	 * @param Month The month used to filter the results.
	 *
	 * @return A DataSet containing the Cron Job History for the specified period,
	 * or FALSE if an error occurred while retrieving it.
	 */
	public function GetByYearMonth($Year, $Month) {
		// DateFrom represents the start date of the period to include in the
		// results.
		$DateFrom = mktime(0, 0, 0, $Month, 1, $Year);

		$ISODateFrom = date('Y-m-d', $DateFrom);
		// DateTo is calculated as "one month after DateFrom".
		$ISODateTo = date('Y-m-d', strtotime($ISODateFrom . ' +1 month'));

		return $this->Get($ISODateFrom, $ISODateTo);
	}

	/**
	 * Allows to insert the results of a Cron Job Execution into the database.
	 *
	 * This function overrides the standard Insert to accept an instance of
	 * CronJobExecutionDataModel instead of an array of values. This has been done to
	 * decouple this class from Vanilla's way of passing data.
	 *
	 * @param CronJobExecutionDataModel CronJobExecutionData An instance of
	 * CronJobExecutionDataModel, containing the details of a Cron Job Execution.
	 */
	public function Insert(CronJobExecutionDataModel $CronJobExecutionData) {
		// Data is converted into an array, as this is the format expected by parent
		// class' Insert() method.
		return parent::Insert($CronJobExecutionData->GetData());
	}
}
