<?php
namespace BabyBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class BabyLoader extends Loader
{
	public function load($resource, $type = null)
	{
		$collection = new RouteCollection();
		
		$resource = '@BabyBundle/routing.yml';
		$type = 'yaml';

		$importedRoutes = $this->import($resource, $type);

		$collection->addCollection($importedRoutes);
		
		return $collection;
	}
}
