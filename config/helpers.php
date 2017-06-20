<?php

return [
	'order_status' => [
		'Creado' => 'Creado',
		'Solicitado' => 'Solicitado',
		//'Confirmado' => 'Confirmado',
		'Ingresado' => 'Ingresado',
		'Cancelado'	=> 'Cancelado'
	],
	'priority' => [
		'Alta' => 'Alta',
		'Media' => 'Media',
		'Baja' => 'Baja'
	],
	'people_types' => [
		'customer' => 'Cliente',
		'provider' => 'Proveedor',
	],
	'gender' => [
		'm' => 'Masculino',
		'f' => 'Femenino'
	],
	'colors' => [
	/*
		'#0000FF' => '#0000FF',
		'#FF00FF' => '#FF00FF',
		'#FF0000' => '#FF0000',
		'#FFFF00' => '#FFFF00',
		'#00FF00' => '#00FF00',
		'#00FFFF' => '#00FFFF',
		'#000000' => '#000000',
		'#FFFFFF' => '#FFFFFF',
		'#000080' => '#000080',
		'#800080' => '#800080',
		'#800000' => '#800000',
		'#008000' => '#008000',
		'#008080' => '#008080',
		'#808080' => '#808080',
		'#C0C0C0' => '#C0C0C0',
		'#1abc9c' => '#1abc9c',
		'#16a085' => '#16a085',
		'#2ecc71' => '#2ecc71',
		'#27ae60' => '#27ae60',
		'#3498db' => '#3498db',
		'#2980b9' => '#2980b9',
		'#9b59b6' => '#9b59b6',
		'#8e44ad' => '#8e44ad',
		'#34495e' => '#34495e',
		'#2c3e50' => '#2c3e50',
		'#f1c40f' => '#f1c40f',
		'#f39c12' => '#f39c12',
		'#e67e22' => '#e67e22',
		'#d35400' => '#d35400',
		'#e74c3c' => '#e74c3c',
		'#c0392b' => '#c0392b',
		'#ecf0f1' => '#ecf0f1',
		'#bdc3c7' => '#bdc3c7',
		'#95a5a6' => '#95a5a6',
		'#7f8c8d' => '#7f8c8d',
		*/
'#1abc9c' => '#1abc9c',
'#17a589' => '#17a589',
'#148f77' => '#148f77',
'#117864' => '#117864',
'#0e6251' => '#0e6251',
'#16a085' => '#16a085',
'#138d75' => '#138d75',
'#117a65' => '#117a65',
'#0e6655' => '#0e6655',
'#0b5345' => '#0b5345',
'#2ecc71' => '#2ecc71',
'#28b463' => '#28b463',
'#239b56' => '#239b56',
'#1d8348' => '#1d8348',
'#186a3b' => '#186a3b',
'#27ae60' => '#27ae60',
'#229954' => '#229954',
'#1e8449' => '#1e8449',
'#196f3d' => '#196f3d',
'#145a32' => '#145a32',
'#3498db' => '#3498db',
'#2e86c1' => '#2e86c1',
'#2874a6' => '#2874a6',
'#21618c' => '#21618c',
'#1b4f72' => '#1b4f72',
'#2980b9' => '#2980b9',
'#2471a3' => '#2471a3',
'#1f618d' => '#1f618d',
'#1a5276' => '#1a5276',
'#154360' => '#154360',
'#9b59b6' => '#9b59b6',
'#884ea0' => '#884ea0',
'#76448a' => '#76448a',
'#633974' => '#633974',
'#512e5f' => '#512e5f',
'#8e44ad' => '#8e44ad',
'#7d3c98' => '#7d3c98',
'#6c3483' => '#6c3483',
'#5b2c6f' => '#5b2c6f',
'#4a235a' => '#4a235a',
'#34495e' => '#34495e',
'#2e4053' => '#2e4053',
'#283747' => '#283747',
'#212f3c' => '#212f3c',
'#1b2631' => '#1b2631',
'#2c3e50' => '#2c3e50',
'#273746' => '#273746',
'#212f3d' => '#212f3d',
'#1c2833' => '#1c2833',
'#17202a' => '#17202a',
'#f1c40f' => '#f1c40f',
'#d4ac0d' => '#d4ac0d',
'#b7950b' => '#b7950b',
'#9a7d0a' => '#9a7d0a',
'#7d6608' => '#7d6608',
'#f39c12' => '#f39c12',
'#d68910' => '#d68910',
'#b9770e' => '#b9770e',
'#9c640c' => '#9c640c',
'#7e5109' => '#7e5109',
'#e67e22' => '#e67e22',
'#ca6f1e' => '#ca6f1e',
'#af601a' => '#af601a',
'#935116' => '#935116',
'#784212' => '#784212',
'#d35400' => '#d35400',
'#ba4a00' => '#ba4a00',
'#a04000' => '#a04000',
'#873600' => '#873600',
'#6e2c00' => '#6e2c00',
'#e74c3c' => '#e74c3c',
'#cb4335' => '#cb4335',
'#b03a2e' => '#b03a2e',
'#943126' => '#943126',
'#78281f' => '#78281f',
'#c0392b' => '#c0392b',
'#a93226' => '#a93226',
'#922b21' => '#922b21',
'#7b241c' => '#7b241c',
'#641e16' => '#641e16',
'#ecf0f1' => '#ecf0f1',
'#d0d3d4' => '#d0d3d4',
'#b3b6b7' => '#b3b6b7',
'#979a9a' => '#979a9a',
'#7b7d7d' => '#7b7d7d',
'#bdc3c7' => '#bdc3c7',
'#a6acaf' => '#a6acaf',
'#909497' => '#909497',
'#797d7f' => '#797d7f',
'#626567' => '#626567',
'#95a5a6' => '#95a5a6',
'#839192' => '#839192',
'#717d7e' => '#717d7e',
'#5f6a6a' => '#5f6a6a',
'#4d5656' => '#4d5656',
'#7f8c8d' => '#7f8c8d',
'#707b7c' => '#707b7c',
'#616a6b' => '#616a6b',
'#515a5a' => '#515a5a',
'#424949' => '#424949',
	],

/*
.turquoise-500 { color: #1abc9c; }
.turquoise-600 { color: #17a589; }
.turquoise-700 { color: #148f77; }
.turquoise-800 { color: #117864; }
.turquoise-900 { color: #0e6251; }

.green-sea-500 { color: #16a085; }
.green-sea-600 { color: #138d75; }
.green-sea-700 { color: #117a65; }
.green-sea-800 { color: #0e6655; }
.green-sea-900 { color: #0b5345; }

.emerald-500 { color: #2ecc71; }
.emerald-600 { color: #28b463; }
.emerald-700 { color: #239b56; }
.emerald-800 { color: #1d8348; }
.emerald-900 { color: #186a3b; }

.nephritis-500 { color: #27ae60; }
.nephritis-600 { color: #229954; }
.nephritis-700 { color: #1e8449; }
.nephritis-800 { color: #196f3d; }
.nephritis-900 { color: #145a32; }

.peter-river-500 { color: #3498db; }
.peter-river-600 { color: #2e86c1; }
.peter-river-700 { color: #2874a6; }
.peter-river-800 { color: #21618c; }
.peter-river-900 { color: #1b4f72; }

.belize-hole-500 { color: #2980b9; }
.belize-hole-600 { color: #2471a3; }
.belize-hole-700 { color: #1f618d; }
.belize-hole-800 { color: #1a5276; }
.belize-hole-900 { color: #154360; }

.amethyst-500 { color: #9b59b6; }
.amethyst-600 { color: #884ea0; }
.amethyst-700 { color: #76448a; }
.amethyst-800 { color: #633974; }
.amethyst-900 { color: #512e5f; }

.wisteria-500 { color: #8e44ad; }
.wisteria-600 { color: #7d3c98; }
.wisteria-700 { color: #6c3483; }
.wisteria-800 { color: #5b2c6f; }
.wisteria-900 { color: #4a235a; }

.wet-asphalt-500 { color: #34495e; }
.wet-asphalt-600 { color: #2e4053; }
.wet-asphalt-700 { color: #283747; }
.wet-asphalt-800 { color: #212f3c; }
.wet-asphalt-900 { color: #1b2631; }

.midnight-blue-500 { color: #2c3e50; }
.midnight-blue-600 { color: #273746; }
.midnight-blue-700 { color: #212f3d; }
.midnight-blue-800 { color: #1c2833; }
.midnight-blue-900 { color: #17202a; }

.sunflower-500 { color: #f1c40f; }
.sunflower-600 { color: #d4ac0d; }
.sunflower-700 { color: #b7950b; }
.sunflower-800 { color: #9a7d0a; }
.sunflower-900 { color: #7d6608; }

.orange-500 { color: #f39c12; }
.orange-600 { color: #d68910; }
.orange-700 { color: #b9770e; }
.orange-800 { color: #9c640c; }
.orange-900 { color: #7e5109; }

.carrot-500 { color: #e67e22; }
.carrot-600 { color: #ca6f1e; }
.carrot-700 { color: #af601a; }
.carrot-800 { color: #935116; }
.carrot-900 { color: #784212; }

.pumpkin-500 { color: #d35400; }
.pumpkin-600 { color: #ba4a00; }
.pumpkin-700 { color: #a04000; }
.pumpkin-800 { color: #873600; }
.pumpkin-900 { color: #6e2c00; }

.alizarin-500 { color: #e74c3c; }
.alizarin-600 { color: #cb4335; }
.alizarin-700 { color: #b03a2e; }
.alizarin-800 { color: #943126; }
.alizarin-900 { color: #78281f; }

.pomegranate-500 { color: #c0392b; }
.pomegranate-600 { color: #a93226; }
.pomegranate-700 { color: #922b21; }
.pomegranate-800 { color: #7b241c; }
.pomegranate-900 { color: #641e16; }

.clouds-500 { color: #ecf0f1; }
.clouds-600 { color: #d0d3d4; }
.clouds-700 { color: #b3b6b7; }
.clouds-800 { color: #979a9a; }
.clouds-900 { color: #7b7d7d; }

.silver-500 { color: #bdc3c7; }
.silver-600 { color: #a6acaf; }
.silver-700 { color: #909497; }
.silver-800 { color: #797d7f; }
.silver-900 { color: #626567; }

.concrete-500 { color: #95a5a6; }
.concrete-600 { color: #839192; }
.concrete-700 { color: #717d7e; }
.concrete-800 { color: #5f6a6a; }
.concrete-900 { color: #4d5656; }

.asbestos-500 { color: #7f8c8d; }
.asbestos-600 { color: #707b7c; }
.asbestos-700 { color: #616a6b; }
.asbestos-800 { color: #515a5a; }
.asbestos-900 { color: #424949; }
*/


];