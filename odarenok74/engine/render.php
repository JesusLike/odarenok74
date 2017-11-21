<?
require_once('../config/config.php');

$templates = [
	'tpl_nav' => 'nav',
	'tpl_header' => 'header',
	'tpl_footer' => 'footer',
	'tpl_main' => 'main'
];


function render($name, $args = null) {
	global $templates;

	$variables = $templates;
	if (!isset($name)) {
		$name = 'index';
	}

	switch ($name) {
		//Full page templates
		case 'index':
			$path = TPL . 'skeleton.php';
			$variables['title'] = 'Главная страница';
			$variables['var_main_content'] = 'index_content';
			$args['page'] = 'index';
			$args['aside-menu'] = [];
			break;

		case 'subjects':
			$path = TPL . 'skeleton.php';
			$variables['title'] = 'Занятия';
			$variables['var_main_content'] = 'subjects_content';
			$args['aside-menu'] = [
				['name' => 'Развивающие', 'adress' => 'index.php?page=subjects&section=educ'],
				['name' => 'ИЗО', 'adress' => 'index.php?page=subjects&section=art'],
				['name' => 'Музыка', 'adress' => 'index.php?page=subjects&section=music'],
				['name' => 'Театр', 'adress' => 'index.php?page=subjects&section=theater'],
				['name' => 'Английский', 'adress' => 'index.php?page=subjects&section=eng'],
				['name' => 'Фитнес', 'adress' => 'index.php?page=subjects&section=fitness']
			];
			break;

		case 'gallery':
			$path = TPL . 'skeleton.php';
			$variables['title'] = 'Галерея';
			$variables['var_main_content'] = 'gallery_content';
			$args['aside-menu'] = [];
			break;

		case 'staff':
			$path = TPL . 'skeleton.php';
			$variables['title'] = 'Сотрудники';
			$variables['var_main_content'] = 'staff_content';
			$args['aside-menu'] = [
				['name' => 'Развивающие', 'adress' => 'index.php?page=staff&section=educ'],
				['name' => 'ИЗО', 'adress' => 'index.php?page=staff&section=art'],
				['name' => 'Музыка', 'adress' => 'index.php?page=staff&section=music'],
				['name' => 'Театр', 'adress' => 'index.php?page=staff&section=theater'],
				['name' => 'Английский', 'adress' => 'index.php?page=staff&section=eng'],
				['name' => 'Фитнес', 'adress' => 'index.php?page=staff&section=fitness']
				];
			break;

		case 'articles':
			$path = TPL . 'skeleton.php';
			$variables['title'] = 'Статьи';
			$variables['var_main_content'] = 'articles_content';
			$args['aside-menu'] = [];
			break;

		case 'contacts':
			$path = TPL . 'skeleton.php';
			$variables['title'] = 'Контакты';
			$variables['var_main_content'] = 'contacts_content';
			$args['aside-menu'] = [];
			break;

		//Pages content templates
		case 'index_content':
			$path = TPL . 'index_content.php';
			break;

		case 'subjects_content':
			$path = TPL . 'subjects_content.php';
			break;

		case 'gallery_content':
			$path = TPL . 'gallery_content.php';
			break;

		case 'staff_content':
			$path = TPL . 'staff_content.php';
			break;

		case 'articles_content':
			$path = TPL . 'articles_content.php';
			break;

		case 'contacts_content':
			$path = TPL . 'contacts_content.php';
			break;

		//Structure parts templates
		case 'header':
			$path = TPL . 'header.php';
			$variables['header_title'] = 'Одарёнок';
			$variables['logo_adress'] = 'img/logo.png';
			$variables['logo_desc'] = 'Одарёнок';
			$variables['big_photo'] = 'img/photo-main.jpg';
			$variables['big_photo_desc'] = 'Фото с занятий';
			break;

		case 'nav':
			$path = TPL . 'nav.php';
			$menu = [
				['name' => 'Главная', 'adress' => 'index.php'],
				['name' => 'Занятия', 'adress' => 'index.php?page=subjects'],
				['name' => 'Галерея', 'adress' => 'index.php?page=gallery'],
				['name' => 'Сотрудники', 'adress' => 'index.php?page=staff'],
				['name' => 'Статьи', 'adress' => 'index.php?page=articles'],
				['name' => 'Контакты', 'adress' => 'index.php?page=contacts']
			];
			break;

		case 'main':
			$path = TPL . 'main.php';
			$aside_menu = $args['aside-menu'];
			break;

		case 'footer':
			$path = TPL . 'footer.php';
			$variables['contacts'] = "yudovichml@gmail.com";
			$variables['author'] = "Dmitri Yudovich&copy;<br>2017";
			break;

		default:
			exit(INVALID_PAGE);
	}

	$template = file_get_contents($path);
	
	ob_start();
	eval("?>$template<?");
	$template = ob_get_contents();
	ob_end_clean();

	foreach ($variables as $variable => $content) {
		$placeholder = '{{' . mb_strtoupper($variable) . '}}';
		$prefix = mb_substr($variable, 0, 3);
		if (($prefix == 'tpl' || $prefix == 'var') && strpos($template, $placeholder)) {
			$content = render($content, $args);
		}
		$template = str_replace($placeholder, $content, $template);
	}

	return $template;
}
?>