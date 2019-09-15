<?php

namespace Kily\Tools1C\ClientBankExchange\Model;

use Kily\Tools1C\ClientBankExchange\Component;

class DocumentSection extends Component
{
    public $type = null;

    public static function fields()
    {
        return [
            'Номер',
            'Дата',
            'Сумма',
            'КвитанцияДата',
            'КвитанцияВремя',
            'КвитанцияСодержание',
            'ПлательщикСчет',
            'ДатаСписано',
            'Плательщик',
            'ПлательщикИНН',
            'Плательщик1',
            'Плательщик2',
            'Плательщик3',
            'Плательщик4',
            'ПлательщикРасчСчет',
            'ПлательщикБанк1',
            'ПлательщикБанк2',
            'ПлательщикБИК',
            'ПлательщикКорсчет',
            'ПолучательСчет',
            'ДатаПоступило',
            'Получатель',
            'ПолучательИНН',
            'Получатель1',
            'Получатель2',
            'Получатель3',
            'Получатель4',
            'ПолучательРасчСчет',
            'ПолучательБанк1',
            'ПолучательБанк2',
            'ПолучательБИК',
            'ПолучательКорсчет',
            'ВидПлатежа',
            'ВидОплаты',
            'Код',
            'НазначениеПлатежа',
            'НазначениеПлатежа1',
            'НазначениеПлатежа2',
            'НазначениеПлатежа3',
            'НазначениеПлатежа4',
            'НазначениеПлатежа5',
            'НазначениеПлатежа6',
            'СтатусСоставителя',
            'ПлательщикКПП',
            'ПолучательКПП',
            'ПоказательКБК',
            'ОКАТО',
            'ПоказательОснования',
            'ПоказательПериода',
            'ПоказательНомера',
            'ПоказательДаты',
            'ПоказательТипа',
            'Очередность',
            'СрокАкцепта',
            'ВидАккредитива',
            'СрокПлатежа',
            'УсловиеОплаты1',
            'УсловиеОплаты2',
            'УсловиеОплаты3',
            'ПлатежПоПредст',
            'ДополнУсловия',
            'НомерСчетаПоставщика',
            'ДатаОтсылкиДок',
        ];
    }

    public function __construct($type, $data = [])
    {
        parent::__construct($data);
        $this->type = $type;

        foreach (['Номер'] as $k) {
            if ($this->data[$k]) {
                $this->data[$k] = $this->toInt($this->data[$k]);
            }
        }

        foreach (['Дата'] as $k) {
            if ($this->data[$k]) {
                $this->data[$k] = $this->toDate($this->data[$k]);
            }
        }

        foreach (['Сумма'] as $k) {
            if ($this->data[$k]) {
                $this->data[$k] = $this->toFloat($this->data[$k]);
            }
        }
    }

    public function __toString() {
        $out = [];

        $out['СекцияДокумент'] = $this->type;

        foreach($this->fields() as $f) {
            if(isset($this->data[$f])) {
                if(in_array($f,['Дата'])) {
                    $out[$f] = $this->toDMYDate($this->data[$f]);
                } else {
                    $out[$f] = $this->data[$f];
                }
            }
        }
        $str  = implode("\n",array_map(function($k,$v){return $k.'='.$v;},array_keys($out),$out))."\n";
        $str .= 'КонецДокумента'."\n";
        return $str;
    }
} 
