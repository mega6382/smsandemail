<?php
namespace Submissions\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Json\Json;

class CKEditor extends AbstractHelper
{

    /**
     * @var
     */
    protected $Config;

    /**
     * @param $Config
     */
    public function __construct($Config)
    {
        $this->Config = $Config;
    }

    /**
     * @param $name
     * @param $options
     *
     * @return string
     */
    public function __invoke($name,$options = array())
    {
        $options = Json::encode(array_merge(
            $this->Config['CKEDITOR'],
            $options
        ), true);

        ?>
        <script type="text/javascript" src="<?php echo $this->view->basePath($this->Config['BasePath']) . '/ckeditor.js' ?>"></script>
        <script type="text/javascript" >
            CKEDITOR.replace( '<?php echo $name; ?>',<?php echo $options?>);
        </script>
    <?php

    }
}
