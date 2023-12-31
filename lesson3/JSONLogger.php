<?php


class JSONLogger {
	protected $objects = [];

	public function addObject( JsonSerializable $obj ): void {
		$this->objects[] = $obj;
	}

	public function log( string $betweenLogs = ',' ): string {
		$logs = array_map( function (JsonSerializable $obj) {
			return $obj->jsonSerialize();
		}, $this->objects );

		return implode( $betweenLogs, $logs );
	}
}