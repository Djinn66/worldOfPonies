<?php


namespace App\Controller\Informations;


use http\Message;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/information")
 * @IsGranted("ROLE_OPTIMISER")
 */
class InformationController extends AbstractController
{

    /**
     * @Route("/mysql", name="information_mysql_index", methods={"GET"})
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function indexMysql(PaginatorInterface $paginator, Request $request): Response
    {
        $table = $request->query->get('message')['Table'];
        $message = $request->query->get('message')['Msg_text'];
        $op = $request->query->get('message')['Op'];

        $tableName = $request->query->get('tableName');
        $moteur = $request->query->get('moteur');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $criteria = ['m' => 'mysql'];

        if ($sortBy == "") {
            $sortBy = 'TABLE_NAME';
        }
        if ($order == "") {
            $order = 'ASC';
        }


        $conn = $this->getDoctrine()->getConnection('ROLE_INFORMATION');//ORDER BY :sortBy

        $sql = '
        SELECT * FROM TABLES
        WHERE TABLE_SCHEMA = :m         
        ';

        if ($tableName != "") {
            $sql .= ' AND TABLE_NAME  =  :tableName';
            $criteria += ['tableName' => $tableName];
        }

        if ($moteur != "") {
            $sql .= ' AND ENGINE =  :moteur';
            $criteria += ['moteur' => $moteur];
        }

        $sql .= ' ORDER BY ' . $sortBy . ' ' . $order;

        $stmt = $conn->prepare($sql);
        $stmt->execute($criteria);

        // returns an array of arrays (i.e. a raw data set)
        $tables = $stmt->fetchAll();

        $pagination = $paginator->paginate(
            $tables,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('informations/mysql/index.html.twig', [
            'tableName' => $tableName,
            'moteur' => $moteur,
            'order' => $order,
            'sortBy' => $sortBy,
            'tables' => $pagination,
            'table' => $table,
            'message' => $message,
            'op'    => $op,
        ]);

        //return  $this->render('informations/mysql/index.html.twig', ['tables' => $result ]);
    }

    /**
     * @Route("/worldofponies", name="information_worldofponies_index", methods={"GET"})
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param array|null $result
     * @return Response
     */
    public function indexWorldOfPonies(PaginatorInterface $paginator, Request $request): Response
    {

        $table = $request->query->get('message')['Table'];
        $message = $request->query->get('message')['Msg_text'];
        $op = $request->query->get('message')['Op'];


        $tableName = $request->query->get('tableName');
        $moteur = $request->query->get('moteur');

        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $criteria = ['m' => 'worldOfPonies_db'];

        if ($sortBy == "") {
            $sortBy = 'TABLE_NAME';
        }
        if ($order == "") {
            $order = 'ASC';
        }


        $conn = $this->getDoctrine()->getConnection('ROLE_INFORMATION');//ORDER BY :sortBy

        $sql = '
        SELECT * FROM TABLES
        WHERE TABLE_SCHEMA = :m         
        ';

        if ($tableName != "") {
            $sql .= ' AND TABLE_NAME  =  :tableName';
            $criteria += ['tableName' => $tableName];
        }

        if ($moteur != "") {
            $sql .= ' AND ENGINE =  :moteur';
            $criteria += ['moteur' => $moteur];
        }

        $sql .= ' ORDER BY ' . $sortBy . ' ' . $order;

        $stmt = $conn->prepare($sql);
        $stmt->execute($criteria);

        // returns an array of arrays (i.e. a raw data set)
        $tables = $stmt->fetchAll();

        $pagination = $paginator->paginate(
            $tables,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('informations/worldOfPonies/index.html.twig', [
            'tableName' => $tableName,
            'moteur' => $moteur,
            'order' => $order,
            'sortBy' => $sortBy,
            'tables' => $pagination,
            'table' => $table,
            'message' => $message,
            'op'    => $op,
        ]);
    }

    /**
     * @Route("/repair", name="information_repair_table", methods={"GET"})
     */
    public function repairTable(Request $request): Response
    {
        $db = $request->query->get('db');
        $tableName = $request->query->get('tableName');

        $conn = $this->getDoctrine()->getConnection('ROLE_INFORMATION');

        $sql = '
        REPAIR TABLE ' . $db . '.' . $tableName . '         
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll()[0];


        if ($db == "mysql") {
            return $this->redirectToRoute('information_mysql_index', array('message' => $result));
        }

        return $this->redirectToRoute('information_worldofponies_index', array('message' => $result));
    }

    /**
     * @Route("/optimize", name="information_optimize_table", methods={"GET"})
     */
    public function optimizeTable(Request $request): Response
    {
        $db = $request->query->get('db');
        $tableName = $request->query->get('tableName');

        $conn = $this->getDoctrine()->getConnection('ROLE_INFORMATION');

        $sql = '
        OPTIMIZE TABLE ' . $db . '.' . $tableName . '         
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll()[0];


        if ($db == "mysql") {
            return $this->redirectToRoute('information_mysql_index', array('message' => $result));
        }

        return $this->redirectToRoute('information_worldofponies_index', array('message' => $result));
    }

    /**
     * @Route("/check", name="information_check_table", methods={"GET"})
     */
    public function checkTable(Request $request): Response
    {
        $db = $request->query->get('db');
        $tableName = $request->query->get('tableName');

        $conn = $this->getDoctrine()->getConnection('ROLE_INFORMATION');

        $sql = '
        CHECK TABLE ' . $db . '.' . $tableName . '         
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll()[0];




        if ($db == "mysql") {
            return $this->redirectToRoute('information_mysql_index', array('message' => $result));
        }

        return $this->redirectToRoute('information_worldofponies_index', array('message' => $result));
    }

}