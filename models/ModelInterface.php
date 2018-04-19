<?php

interface ModelInterface
{
	public function all();
	
	public function find($id);

	public function create();

	public function update();

	public function destroy($id);
}