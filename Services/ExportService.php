<?php

namespace ITDoors\CommonBundle\Services;

use Symfony\Component\DependencyInjection\Container;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;

/**
 * Class ExportService
 */
class ExportService
{

    protected $container;

    /**
     * @param Container $container
     */
    public function __construct (Container $container)
    {
        $this->container = $container;
    }
    /**
     * getExel
     * $services = $this->container->get('itdoors_common.export.service');
     * $phpExcelObject =  $services->getExcel($data);
     * 
     * @param mixed[] $data
     *
     * @return object
     */
    public function getExcel ($data)
    {
        /** @var Translator $translator */
        $translator = $this->container->get('translator');

        // ask the service for a Excel5
        $phpExcelObject = $this->container->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("DebtControll")
            ->setLastModifiedBy("DebtControll")
            ->setTitle("List")
            ->setSubject("DebtControll")
            ->setDescription("DebtControll")
            ->setKeywords("DebtControll")
            ->setCategory("DebtControll");
        $phpExcelObject->setActiveSheetIndex(0);

        if (is_array($data)) {
            $keys = array_keys($data[0]);
            $str = 1;
            $col = 0;
            foreach ($keys as $key) {
                $phpExcelObject->getActiveSheet()
                    ->setCellValueByColumnAndRow(
                        $col++,
                        $str,
                        $translator->trans($key, array (), 'ITDoorsCommonBundle')
                    );
            }
            foreach ($data as $val) {
                $col = 0;
                ++$str;
                foreach ($keys as $key) {
                    $value = $val[$key];
                    if (gettype($value) == 'object') {
                        if (get_class($value) == 'DateTime') {
                            $value = $value->format('Y-m-d H:i:s');
                        }
                    }
                    $phpExcelObject->getActiveSheet()->setCellValueByColumnAndRow($col++, $str, $value);
                }
            }
        }
        $phpExcelObject->getActiveSheet()
            ->getStyle('A1:AQ1')
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$phpExcelObject->getActiveSheet()->getStyle('A2:AQ'.$str)->getAlignment()->setWrapText(true);
        $phpExcelObject->getActiveSheet()->freezePane('AB2');
        $phpExcelObject->getActiveSheet()->setTitle('List');

        return $phpExcelObject;
    }
    /**
     * getResponse
     * $services = $this->container->get('itdoors_common.export.service');
     * $response =  $services->getResponse($phpExcelObject, $fileName);
     * return $response;
     * 
     * @param object $phpExcelObject
     * @param string $fileName
     * 
     * @return response
     */
    public function getResponse ($phpExcelObject, $fileName)
    {
        $writer = $this->container->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        $response = $this->container->get('phpexcel')->createStreamedResponse($writer);
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=' . $fileName . '.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }
}
