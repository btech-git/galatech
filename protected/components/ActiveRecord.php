<?php

class ActiveRecord extends CActiveRecord
{
	const ACTIVE = 0;
	const INACTIVE = 1;

	public function status()
	{
		return ($this->is_inactive) ? 'Inactive' : 'Active';
	}

	public function scopes()
	{
		return array(
			'active' => array(
				'condition' => 'is_inactive = :is_inactive',
				'params' => array(':is_inactive' => self::ACTIVE),
			),
			'inactive' => array(
				'condition' => 'is_inactive = :is_inactive',
				'params' => array(':is_inactive' => self::INACTIVE),
			),
			'latest' => array(
				'order' => 'id DESC',
			),
			'oldest' => array(
				'order' => 'id ASC',
			),
		);
	}

	public function defaultScope()
	{
		$alias = $this->getTableAlias(false, false);

		return array(
			'condition' => "{$alias}.is_inactive = :is_inactive",
			'params' => array(':is_inactive' => self::ACTIVE),
		);
	}
}