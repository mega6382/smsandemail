<?php
include 'providers/MailSender.php';
include 'providers/ClickaTell.php';
return array(
     'controllers' => array(
         'invokables' => array(
             'Submissions\Controller\Submissions' => 'Submissions\Controller\SubmissionsController',
			 'CKEditor' => 'CKEditor\Controller\CKEditor',
      
         ),
     ),
	      'router' => array(
         'routes' => array(
             'submissions' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/submissions[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Submissions\Controller\Submissions',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'QuConfig' => array(
        'CKEditor' => array
        (
            'QuElFinderWindowWidth'  => "800",
            'QuElFinderWindowHeight' => "600",

            'BasePath' =>'/js/plugins/ckeditor', // Require!!
            'CKEDITOR' => array(

                'filebrowserBrowseUrl'    => '/quelfinder/ckeditor',
                'filebrowserWindowWidth'  => "1000",
                'filebrowserWindowHeight' => "600",

                'Width'      => "100%",
                'Height'     => "340",
                'language'   => 'en',
                'uiColor'=> '#F6F6F6',

                //Producing HTML Compliant Output
                'coreStyles_bold'   => array('element' => 'b'),
                'coreStyles_italic' => array('element' => 'i'),
                'fontSize_style'    => array('element' => 'font','attributes' => array( 'size' => '100px')),

                //MagiCline plugin
                'magicline_color'=>'blue',

                //Full Page Editing
                'fullPage' => false,
                'allowedContent' => false,

                // Toolbars config
                'toolbar' => null,
                //'toolbarGroups' => null,

                // Full toolbars
                /*
                'toolbar' => array(
                    array('name'=> 'clipboard',
                        'groups'=> array( 'clipboard', 'undo' ),
                        'items' => array( 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' )
                    ),
                    array( 'name'=> 'editing',
                        'groups' => array( 'find', 'selection', 'spellchecker'),
                        'items' => array( 'Scayt'),
                    ),
                    array( 'name'=> 'links',
                        'items' => array( 'Link', 'Unlink', 'Anchor' ),
                    ),
                    array( 'name'=> 'insert',
                        'items' => array( 'Image', 'Table', 'HorizontalRule', 'SpecialChar'),
                    ),
                    array( 'name'=> 'tools',
                        'items' => array( 'Maximize'),
                    ),
                    array( 'name'=> 'document',
                        'groups' => array( 'mode', 'document', 'doctools' ), 'items' => array('Source')
                    ),
                    array( 'name'=> 'others',
                        'items' => array( '-' ),
                    ),
                    '/',
                    array( 'name'=> 'basicstyles',
                        'groups' => array( 'basicstyles', 'cleanup' ),
                        'items' => array( 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ),
                    ),
                    array( 'name'=> 'paragraph',
                        'groups' => array( 'list', 'indent', 'blocks', 'align' ),
                        'items' => array( 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ),
                    ),
                    array( 'name'=> 'styles',
                        'items' => array( 'Styles', 'Format' ),
                    ),
                    array( 'name'=> 'about',
                        'items' => array( 'About' ),
                    ),
                ),
                */
                /*
                 // Groups toolbars
                'toolbarGroups' => array(
                    array( 'name'=> 'clipboard',
                        'groups'=> array('clipboard', 'undo')
                    ),
                    array( 'name'=> 'editing',
                        'groups'=> array( 'find', 'selection', 'spellchecker')
                    ),
                    array( 'name'=> 'links'),
                    array( 'name'=> 'insert'),
                    array( 'name'=> 'forms'),
                    array( 'name'=> 'document',
                        'groups'=> array( 'find', 'selection', 'spellchecker')
                    ),
                    array( 'name'=> 'others'),
                    '/',
                    array( 'name'=> 'document',
                        'groups'=> array( 'basicstyles', 'cleanup')
                    ),
                    array( 'name'=> 'paragraph',
                        'groups'=> array( 'list', 'indent', 'blocks', 'align')
                    ),
                    array( 'name'=> 'styles'),
                    array( 'name'=> 'colors'),
                    array( 'name'=> 'about')
                ),
                */

            ),
        ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'submission' => __DIR__ . '/../view',
         ),
     ),
    'Submissions\Provider\Config'=>array_merge($t,$r),
 );
 ?>