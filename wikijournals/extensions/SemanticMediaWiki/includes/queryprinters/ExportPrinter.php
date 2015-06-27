<?php

namespace SMW;

use SMWQueryResult;

/**
 * Interface for SMW export related result printers
 *
 * @license GNU GPL v2+
 * @since 1.8
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface ExportPrinter extends QueryResultPrinter {

	/**
	 * Outputs the result as file.
	 *
	 * @since 1.8
	 *
	 * @param SMWQueryResult $queryResult
	 * @param array $params
	 */
	public function outputAsFile( SMWQueryResult $queryResult, array $params );

	/**
	 * Some printers do not mainly produce embeddable HTML or Wikitext, but
	 * produce stand-alone files. An example is RSS or iCalendar. This function
	 * returns the mimetype string that this file would have, or FALSE if no
	 * standalone files are produced.
	 *
	 * If this function returns something other than FALSE, then the printer will
	 * not be regarded as a printer that displays in-line results. This is used to
	 * determine if a file output should be generated in Special:Ask.
	 *
	 * @since 1.8
	 *
	 * @param SMWQueryResult $queryResult
	 *
	 * @return string
	 */
	public function getMimeType( SMWQueryResult $queryResult );

	/**
	 * Some printers can produce not only embeddable HTML or Wikitext, but
	 * can also produce stand-alone files. An example is RSS or iCalendar.
	 * This function returns a filename that is to be sent to the caller
	 * in such a case (the default filename is created by browsers from the
	 * URL, and it is often not pretty).
	 *
	 * @param SMWQueryResult $queryResult
	 *
	 * @return string|boolean
	 */
	public function getFileName( SMWQueryResult $queryResult );

}