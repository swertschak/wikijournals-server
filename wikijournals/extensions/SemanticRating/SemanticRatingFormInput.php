<?php
/*
 * Copyright (c) 2014 The MITRE Corporation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 */

class SemanticRatingFormInput extends SFFormInput {

	private static $imagepath = null;

	public static function setImagePath($value) {
		self::$imagepath = $value;
	}

	public function __construct($input_number, $cur_value, $input_name,
		$disabled, $other_args) {
		parent::__construct($input_number, $cur_value, $input_name, $disabled,
			$other_args);
		if (array_key_exists('max', $this->mOtherArgs)) {
			$this->mMax = $this->mOtherArgs['max'];
		} else {
			$this->mMax = $GLOBALS['SemanticRating_DefaultMax'];
		}
	}

	public static function getName() {
		return 'rating';
	}

	public function getHtmlText() {

		if (!is_numeric($this->mCurrentValue) || $this->mCurrentValue < 0 ||
			$this->mCurrentValue > $this->mMax) {
			$this->mCurrentValue = 0;
		}

		$output =
			Html::openElement('table', array('style' => 'display:inline;')) .
			Html::openElement('td');

		$input_id = "input_" . $GLOBALS['sfgFieldNum'];
		$output .= Html::element('input', array(
			'type' => 'hidden',
			'id' => $input_id,
			'name' => $this->mInputName,
			'value' => $this->mCurrentValue
			));

		$i = 1;

		$src =	self::$imagepath . 'yellowstar.png';
		while ($i < $this->mCurrentValue + 1) {
			$output .= Html::element('img', array(
				'src' => $src,
				'id' => $input_id . '_s_' . $i,
				'onclick' => 'semanticRating.setrating(' . $i . ",'" . $input_id . "'," .
					$this->mMax . ');'
				));
			$i++;
		}

		$src =	self::$imagepath . 'greystar.png';
		while ($i <= $this->mMax) {
			$output .= Html::element('img', array(
				'src' => $src,
				'id' => $input_id . '_s_' . $i,
				'onclick' => 'semanticRating.setrating(' . $i . ",'" . $input_id . "'," .
					$this->mMax . ');'
				));
			$i++;
		}

		$output .=
			Html::closeElement('td') .
			Html::closeElement('table');

		return $output;
	}

	public static function getParameters() {
		$params = parent::getParameters();
		$params[] = array(
			'name' => 'max',
			'type' => 'int',
			'description' => wfMessage('semanticrating-max')->text()
		);
		return $params;
	}

	public function getResourceModuleNames() {
		return array(
			'ext.SemanticRating'
		);
	}
}
