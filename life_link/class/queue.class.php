<?php
/**
* Queue class - under PHP 5
*
* @description This is an implementation of FIFO (First In First Out) queue.
*
*
* @example example.php Simple example of puting ang geting datas from queue
*
* @requirement PHP 5
*
*
*/


/**
* Default size of queue
*/
define( 'QUEUE_DEFAULT_SIZE', 15 );


/**
* Abstract class AQueue of FIFO queue
* @version 1.5
*/
abstract class AQueue
{
  /**
  * Queue constructor
  * @param int $intQueue - size of queue
  */
  abstract public function __construct( $intSize = QUEUE_DEFAULT_SIZE );

  /**
  * Queue destructor
  * Destroy queue items array
  */
  abstract public function __destruct();

  /**
  * Add item to queue
  * @param obj &$objQueueItem - queue item object
  * @return true if added to queue or false if queue is full and item could not be added
  */
  abstract public function EnQueue( &$objQueueItem );

  /**
  * Get item from queue
  * @return object (queue iteme) or false if there is now items in queue
  */
  abstract public function DeQueue();

  /**
  * Check if queue is empty
  * @return true if it is empty or false if not
  */
  abstract protected function IsEmpty();

  /**
  * Clear queue
  */
  abstract protected function Clear();
}


/**
* Implementation of abstract class AQueue
* @version 1.9
*/
class Queue extends AQueue
{
  private
    $intBegin,       // Begin of queue - head
    $intEnd,         // End of queue - tail
    $intArraySize,   // Size of array
    $intCurrentSize; // Current size of array
  public $arrQueue;       // Array of queue items

  public function __construct( $intSize = QUEUE_DEFAULT_SIZE )
  {
    $this->arrQueue     = Array();
    $this->intArraySize = $intSize;

    $this->Clear();
  }
  

  public function __destruct()
  {
    unset( $this->arrQueue );
  }


  public function EnQueue( &$objQueueItem  )
  {
   /* if ( $this->intCurrentSize >= $this->intArraySize )
    {
      return false;
    }
	//intArraySize = QUEUE_DEFAULT_SIZE 14
    if ( $this->intEnd == $this->intArraySize - 1 )
    {
      $this->intEnd = 0;
    }
    else
    {
      $this->intEnd++;
    }*/
	$this->arrQueue[ $this->intEnd ] = $objQueueItem;
	$this->intEnd++;
	$this->intCurrentSize++;
		
    
    
    return true;
  }
  
 
  public function DeQueue()
  {
    if ( $this->IsEmpty() ){
      return false;
    }
    
    $objItem = $this->arrQueue[$this->intBegin];
    
    /*if ( $this->intBegin == $this->intArraySize - 1 )
    {
      $this->intBegin = 0;
    }
    else
    {
      $this->intBegin++;
    }*/
	$this->intBegin++;
    $this->intCurrentSize--;

    return $objItem;
  }

  protected function IsEmpty()
  {
    return ( $this->intCurrentSize == 0 ? true : false );
  }


  protected function Clear()
  {
    $this->arrCurrentSize = 0;
    $this->intBegin       = 0;
    #$this->intEnd         = $this->intArraySize - 1;
	$this->intEnd         = 0;
  }
  
}
?>
