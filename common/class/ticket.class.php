<?php 

class Ticket extends KLib\BaseModel {

	/**
	 * Ticket Id Mongo
	 * @var String
	 */
	protected $id = null;

	/**
	 * Ticket Ref
	 * @var String
	 */
	protected $ref = '';

	/**
	 * Ticket label
	 * @var String
	 */
	protected $label = '';

	/**
	 * Ticket priority 
	 * @var String
	 */
	protected $priority = 'n';

	/**
	 * Ticket user id
	 * @var String
	 */
	protected $userId = '';

	/**
	 * Ticket user technician id
	 * @var String
	 */
	protected $techicianId = '';

	/**
	 * Ticket description
	 * @var String
	 */
	protected $description = '';

	/**
	 * Ticket material(s)
	 * @var array
	 */
	protected $material = array();

	/**
	 * Ticket Date Create
	 * @var int
	 */
	protected $dateCrea = 0;

	/**
	 * Ticket Date last update
	 * @var int
	 */
	protected $lastUpdate = 0;

	/**
	* Ticket Date Close ticket
	* @var int
	*/
	protected $dateClose = 0;

	public function __construct($id = null) {
		if (is_a($id, 'MongoId'))
			$id = (string)$id;
		if (is_string($id)) {
			$data = KLib\MongoDB::findOne(array('_id'=> $id), 'ticket');
			$this->id 		= 	(string)$data['_id'];
			$this->ref 		= 	(string)$data['ref'];
			$this->label 	= 	(string)$data['label'];
			$this->priority = 	(string)$data['priority'];
			$this->userId	=	(string)$data['userId'];
			$this->techicianId =(string)$data['techicianId'];
			$this->description =(string)$data['description'];
			$this->material = 	(array)$data['material'];
			$this->dateCrea = 	(int)$data['dateCrea'];
			$this->lastUpdate = (int)$data['lastUpdate'];
			$this->dateClose =  (int)$data['dateClose'];
		} elseif (!is_null($id)) {
			throw new Exception("INVALID TICKET ID", 500);
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getRef() {
		return $this->ref;
	}

	public function getLabel() {
		return $this->label;
	}
}