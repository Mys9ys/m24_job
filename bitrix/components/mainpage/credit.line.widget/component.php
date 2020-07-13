<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<? 
	//Проверяем и инициализируем входящие параметры компонента 
	if(false) 
	{ 
		//Вывод данных из кеша
	} 
	else
	{
		$arResult['componentPath'] = $this->GetPath();
		
		$userID = $USER->GetID();
		
		if(!empty($userID) && $userID != 0) 
		{
			$arResult['userData'] = CUser::GetByID($userID)->Fetch();
			
			$arResult['fullname'] = trim($arResult['userData']['LAST_NAME'].' '.$arResult['userData']['NAME'].' '.$arResult['userData']['SECOND_NAME']);
			if(!empty($arResult['userData']['PERSONAL_MOBILE'])) 
			{
				$arResult['phone'] = $arResult['userData']['PERSONAL_MOBILE'];
			}
			elseif(!empty($arResult['userData']['PERSONAL_PHONE']))
			{
				$arResult['phone'] = $arResult['userData']['PERSONAL_PHONE'];
			}
			
			$arResult['email'] = $arResult['userData']['EMAIL'];
		}
		
		$this->IncludeComponentTemplate(); 
		// Дописать кэширование вывода
	} 
?>