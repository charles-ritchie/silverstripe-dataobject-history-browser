<?php
/**
 * Test retrieval of data via DataObjectHistoryController.
 *
 * @package silverstripe-dataobject-history-browser
 * @subpackage tests
 */
class DataObjectHistoryControllerTest extends SapphireTest {
    protected static $fixture_file = 'DataExtensionTest.yml';

    protected $extraDataObjects = array(
		'DataObjectHistoryControllerTest_VersionedDataObject'
	);

    protected $requiredExtensions = array(
        'DataObject' => array('Versioned')
    );

    protected function createVersionedDataObject() {
        Versioned::set_reading_mode('Stage.Stage');

		$versionData = $conf = Config::inst()->get(
			'DataObjectHistoryControllerTest', 'versiondata');

		$dataObject = new DataObjectHistoryControllerTest_VersionedDataObject();

		foreach ($versionData as $key => $value) {
			$dataObject->Title = $value['Title'];
			$dataObject->Description = $value['Description'];

			$dataObject->write();
		}

        return $dataObject;
    }

}

class DataObjectHistoryControllerTest_VersionedDataObject extends DataObject {
    private static $db = array(
        'Title'       => 'Varchar(255)',
        'Description' => 'Text'
    );
}
