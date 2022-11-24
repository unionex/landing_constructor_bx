<? /** @var $block array */ ?>
<? //todo: По всему проекту данный блок версткой. Требуется обернуть в компонент. ;?>

<section class="section-rd section-rd--has-padding-bottom <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>" data-attr="section-end-block">
    <div class="container-rd">
        <h2 class="section-rd__h2"><?=$block['head'];?></h2>
        <?=$block['text'];?>
        <div data-no-slide="true" class="tabs-block _transformed profteam-section__tabs appWidgetTabsBlock">
            <div class="tabs-block__changers-wrap _hideable">
                <ul class="tabs-block__tab-changers">
                    <li class="tabs-block__link-holder _active"><a href="#" class="dotted-link">Генеральный директор</a></li>
                    <li class="tabs-block__link-holder"><a href="#" class="dotted-link">Менеджеры по&nbsp;качеству</a></li>
                    <li class="tabs-block__link-holder"><a href="#" class="dotted-link">Руководители проектов</a></li>
                    <li class="tabs-block__link-holder"><a href="#" class="dotted-link">Консультанты и&nbsp;аналитики</a></li>
                    <li class="tabs-block__link-holder"><a href="#" class="dotted-link">Программисты</a></li>
                </ul>
            </div>
            <div class="tabs-block__tabs">
                <div class="tabs-block__tab _active">
                    <!-- Начало блока: Обращение сотрудника-->
                    <div class="team-person">
                        <div class="team-person__mobile-caption">Руководитель компании</div>
                        <div class="team-person__photo"><img src="/local/templates/main/img/content/team-person1.jpg" alt="Фото" class="team-person__img"></div>
                        <div class="team-person__content">
                            <div class="team-person__name _lg">Александр Прямоносов:</div>
                            <div class="team-person__text">
                                <?=$block['textMsg'];?>
                                <div class="team-person__sign"><img src="/local/templates/main/img/content/sign.png" alt="Подпись"></div>


                            </div>
                        </div>
                    </div>
                    <!-- Конец блока: Обращение сотрудника-->
                </div>
                <div class="tabs-block__tab">
                    <!-- Начало блока: Обращение сотрудника-->
                    <div class="team-person _w-500 _w-730">
                        <div class="team-person__graph-holder"><img src="/local/templates/main/img/content/chart.png" alt="5%" width="260" height="260" class="team-person__graph">
                            <div class="team-person__graph-caption">Доля участия специалистов в&nbsp;вашем проекте</div>
                            <div class="team-person__graph-remark">*Информация представлена для среднестатичтического проекта по&nbsp;классической технологии</div>
                        </div>
                        <div class="team-person__content-persons">
                            <div class="team-person__text content-area">
                                <div class="h3">Какие вопросы решают для вас:</div>
                                <ul>
                                    <li>Непрерывный мониторинг соблюдения процедур системы управления качеством, соответствующих международному стандарту ISO 9001:2015;</li>
                                    <li>Опросы и&nbsp;анкетирование: оценка удовлетворенности заказчиков предоставлением услуг компанией;</li>
                                    <li>Регулярное формирование
                                        <nobr>отчетов-рекомендаций</nobr> для руководителя компании в&nbsp;случае идентификаций несоответствий, инициация внеплановых совещаний с&nbsp;целью анализа и&nbsp;планирования корректирующих мероприятий.</li>
                                </ul>
                            </div>
                            <div class="team-person__staff">
                                <div class="b-personal-photos">
                                    <ul class="b-personal-photos__plates">
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person35.jpg" alt="Овчинников Сергей" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person35_smile.jpg" alt="Овчинников Сергей" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Овчинников Сергей</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person36.jpg" alt="Плешко Алина Александровна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person36_smile.jpg" alt="Плешко Алина Александровна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Плешко Алина Александровна</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Конец блока: Обращение сотрудника-->
                </div>
                <div class="tabs-block__tab">
                    <!-- Начало блока: Обращение сотрудника-->
                    <div class="team-person _w-500 _w-730">
                        <div class="team-person__graph-holder"><img src="/local/templates/main/img/content/chart2.png" alt="5%" width="260" height="260" class="team-person__graph">
                            <div class="team-person__graph-caption">Доля участия специалистов в&nbsp;вашем проекте</div>
                            <div class="team-person__graph-remark">*Информация представлена для среднестатичтического проекта по&nbsp;классической технологии</div>
                        </div>
                        <div class="team-person__content-persons">
                            <div class="team-person__text content-area">
                                <div class="h3">Какие вопросы решают для вас:</div>
                                <ul>
                                    <li>Непрерывный мониторинг соблюдения процедур системы управления качеством, соответствующих международному стандарту ISO 9001:2015;</li>
                                    <li>Опросы и&nbsp;анкетирование: оценка удовлетворенности заказчиков предоставлением услуг компанией;</li>
                                    <li>Регулярное формирование
                                        <nobr>отчетов-рекомендаций</nobr> для руководителя компании в&nbsp;случае идентификаций несоответствий, инициация внеплановых совещаний с&nbsp;целью анализа и&nbsp;планирования корректирующих мероприятий.</li>
                                </ul>
                            </div>
                            <div class="team-person__staff">
                                <div class="b-personal-photos">
                                    <ul class="b-personal-photos__plates">
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person30.jpg" alt="Федоров Валерий" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person30_smile.jpg" alt="Федоров Валерий" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Федоров Валерий</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person31.jpg" alt="Ропперт Алексей Алексеевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person31_smile.jpg" alt="Ропперт Алексей Алексеевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Ропперт Алексей Алексеевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person32.jpg" alt="Ромза Антон Сергеевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person32_smile.jpg" alt="Ромза Антон Сергеевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Ромза Антон Сергеевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person33.jpg" alt="Кравцова Ольга Викторовна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person33_smile.jpg" alt="Кравцова Ольга Викторовна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Кравцова Ольга Викторовна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person34.jpg" alt="Котляр Семен" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person34_smile.jpg" alt="Котляр Семен" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Котляр Семен</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person37.jpg" alt="Бреус Вадим Юрьевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person37_smile.jpg" alt="Бреус Вадим Юрьевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Бреус Вадим Юрьевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo">
                                                <img src="/local/templates/main/img/content/persons/person38.jpg" alt="Оводков Василий" width="123" height="143" class="b-personal-photo__pure">
                                                <img src="/local/templates/main/img/content/persons/person38_smile.jpg" alt="Оводков Василий" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Оводков Василий</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="b-personal-photos__more-holder"><a href="#" class="b-personal-photos__more"><span>Посмотреть еще <span class="js-qtty">3</span> специалистов</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Конец блока: Обращение сотрудника-->
                </div>
                <div class="tabs-block__tab">
                    <!-- Начало блока: Обращение сотрудника-->
                    <div class="team-person _w-500 _w-730">
                        <div class="team-person__graph-holder"><img src="/local/templates/main/img/content/chart3.png" alt="5%" width="260" height="260" class="team-person__graph">
                            <div class="team-person__graph-caption">Доля участия специалистов в&nbsp;вашем проекте</div>
                            <div class="team-person__graph-remark">*Информация представлена для среднестатичтического проекта по&nbsp;классической технологии</div>
                        </div>
                        <div class="team-person__content-persons">
                            <div class="team-person__text content-area">
                                <div class="h3">Какие вопросы решают для вас:</div>
                                <ul>
                                    <li>Непрерывный мониторинг соблюдения процедур системы управления качеством, соответствующих международному стандарту ISO 9001:2015;</li>
                                    <li>Опросы и&nbsp;анкетирование: оценка удовлетворенности заказчиков предоставлением услуг компанией;</li>
                                    <li>Регулярное формирование
                                        <nobr>отчетов-рекомендаций</nobr> для руководителя компании в&nbsp;случае идентификаций несоответствий, инициация внеплановых совещаний с&nbsp;целью анализа и&nbsp;планирования корректирующих мероприятий.</li>
                                </ul>
                            </div>
                            <div class="team-person__staff">
                                <div class="b-personal-photos">
                                    <ul class="b-personal-photos__plates">
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person1.jpg" alt="Беппиева Нана Анатольевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person1_smile.jpg" alt="Беппиева Нана Анатольевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Беппиева Нана Анатольевна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person2.jpg" alt="Брыкина Ирина Николаевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person2_smile.jpg" alt="Брыкина Ирина Николаевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Брыкина Ирина Николаевна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person3.jpg" alt="Глухова Светлана Евгеньевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person3_smile.jpg" alt="Глухова Светлана Евгеньевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Глухова Светлана Евгеньевна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person4.jpg" alt="Духанин Павел Борисович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/person4_smile.jpg" alt="Духанин Павел Борисович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Духанин Павел Борисович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person14.jpg" alt="Демина Евгения" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/person14_smile.jpg" alt="Демина Евгения" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Демина Евгения</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person15.jpg" alt="Югова Анастасия Юрьевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person15_smile.jpg" alt="Югова Анастасия Юрьевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Югова Анастасия Юрьевна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person16.jpg" alt="Федулов Сергей Анатольевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person16_smile.jpg" alt="Федулов Сергей Анатольевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Федулов Сергей Анатольевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person17.jpg" alt="Удалов Владимир Викторович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person17_smile.jpg" alt="Удалов Владимир Викторович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Удалов Владимир Викторович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person18.jpg" alt="Тельнова Светлана Анатольевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person18_smile.jpg" alt="Тельнова Светлана Анатольевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Тельнова Светлана Анатольевна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person19.jpg" alt="Слюсаренко Евгений Александрович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person19_smile.jpg" alt="Слюсаренко Евгений Александрович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Слюсаренко Евгений Александрович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person20.jpg" alt="Романовская Светлана Викторовна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person20_smile.jpg" alt="Романовская Светлана Викторовна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Романовская Светлана Викторовна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person21.jpg" alt="Романенко Юрий Сергеевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person21_smile.jpg" alt="Романенко Юрий Сергеевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Романенко Юрий Сергеевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person22.jpg" alt="Полянин Иван Александрович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person22_smile.jpg" alt="Полянин Иван Александрович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Полянин Иван Александрович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person23.jpg" alt="Махмудова Галина Раисовна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person23_smile.jpg" alt="Махмудова Галина Раисовна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Махмудова Галина Раисовна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person24.jpg" alt="Мартынов Захар Геннадиевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person24_smile.jpg" alt="Мартынов Захар Геннадиевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Мартынов Захар Геннадиевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person25.jpg" alt="Мамукова Елена Геннадьевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person25_smile.jpg" alt="Мамукова Елена Геннадьевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Мамукова Елена Геннадьевна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person26.jpg" alt="Львова Алла Михайловна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person26_smile.jpg" alt="Львова Алла Михайловна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Львова Алла Михайловна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person27.jpg" alt="Егорова Елена Анатольевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person27_smile.jpg" alt="Егорова Елена Анатольевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Егорова Елена Анатольевна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person28.jpg" alt="Евстратова Наталья Анатольевна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person28_smile.jpg" alt="Евстратова Наталья Анатольевна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Евстратова Наталья Анатольевна</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="b-personal-photos__more-holder"><a href="#" class="b-personal-photos__more"><span>Посмотреть еще <span class="js-qtty">15</span> специалистов</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Конец блока: Обращение сотрудника-->
                </div>
                <div class="tabs-block__tab">
                    <!-- Начало блока: Обращение сотрудника-->
                    <div class="team-person _w-500 _w-730">
                        <div class="team-person__graph-holder"><img src="/local/templates/main/img/content/chart4.png" alt="5%" width="260" height="260" class="team-person__graph">
                            <div class="team-person__graph-caption">Доля участия специалистов в&nbsp;вашем проекте</div>
                            <div class="team-person__graph-remark">*Информация представлена для среднестатичтического проекта по&nbsp;классической технологии</div>
                        </div>
                        <div class="team-person__content-persons">
                            <div class="team-person__text content-area">
                                <div class="h3">Какие вопросы решают для вас:</div>
                                <ul>
                                    <li>Непрерывный мониторинг соблюдения процедур системы управления качеством, соответствующих международному стандарту ISO 9001:2015;</li>
                                    <li>Опросы и&nbsp;анкетирование: оценка удовлетворенности заказчиков предоставлением услуг компанией;</li>
                                    <li>Регулярное формирование
                                        <nobr>отчетов-рекомендаций</nobr> для руководителя компании в&nbsp;случае идентификаций несоответствий, инициация внеплановых совещаний с&nbsp;целью анализа и&nbsp;планирования корректирующих мероприятий.</li>
                                </ul>
                            </div>
                            <div class="team-person__staff">
                                <div class="b-personal-photos">
                                    <ul class="b-personal-photos__plates">
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person5.jpg" alt="Топорков Александр Анатольевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person5_smile.jpg" alt="Топорков Александр Анатольевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Топорков Александр Анатольевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person6.jpg" alt="Сластная Елена Александровна" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person6_smile.jpg" alt="Сластная Елена Александровна" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Сластная Елена Александровна</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person7.jpg" alt="Постнов Евгений Дмитриевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person7_smile.jpg" alt="Постнов Евгений Дмитриевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Постнов Евгений Дмитриевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person8.jpg" alt="Осокин Владимир Вячеславович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person8_smile.jpg" alt="Осокин Владимир Вячеславович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Осокин Владимир Вячеславович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person9.jpg" alt="Мустафин Марат Магруфович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person9_smile.jpg" alt="Мустафин Марат Магруфович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Мустафин Марат Магруфович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person10.jpg" alt="Корнеев Дмитрий Олегович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person10_smile.jpg" alt="Корнеев Дмитрий Олегович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Корнеев Дмитрий Олегович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person11.jpg" alt="Калюкин Владислав Владимирович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person11_smile.jpg" alt="Калюкин Владислав Владимирович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Калюкин Владислав Владимирович</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person12.jpg" alt="Иншаков Илья Юрьевич" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person12_smile.jpg" alt="Иншаков Илья Юрьевич" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Иншаков Илья Юрьевич</span></div>
                                            </div>
                                        </li>
                                        <li class="b-personal-photos__plate _hide">
                                            <div class="b-personal-photo"><img src="/local/templates/main/img/content/persons/person13.jpg" alt="Дроздов Павел Александрович" width="123" height="143" class="b-personal-photo__pure"><img src="/local/templates/main/img/content/persons/person13_smile.jpg" alt="Дроздов Павел Александрович" width="123" height="143" class="b-personal-photo__smile">
                                                <div class="b-personal-photo__title"><span>Дроздов Павел Александрович</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="b-personal-photos__more-holder"><a href="#" class="b-personal-photos__more"><span>Посмотреть еще <span class="js-qtty">5</span> специалистов</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Конец блока: Обращение сотрудника-->
                </div>
            </div>
        </div>
        <!-- Конец блока: Контент в табах-->
    </div>
</section>
