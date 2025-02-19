<?php
/**
 * Autogenerated by Thrift
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';

include_once $GLOBALS['THRIFT_ROOT'].'/packages/Types/Types_types.php';
include_once $GLOBALS['THRIFT_ROOT'].'/packages/Errors/Errors_types.php';

$GLOBALS['edam_userstore_E_SponsoredGroupRole'] = array(
  'GROUP_MEMBER' => 1,
  'GROUP_ADMIN' => 2,
  'GROUP_OWNER' => 3,
);

final class edam_userstore_SponsoredGroupRole {
  const GROUP_MEMBER = 1;
  const GROUP_ADMIN = 2;
  const GROUP_OWNER = 3;
  static public $__names = array(
    1 => 'GROUP_MEMBER',
    2 => 'GROUP_ADMIN',
    3 => 'GROUP_OWNER',
  );
}

class edam_userstore_PublicUserInfo {
  static $_TSPEC;

  public $userId = null;
  public $shardId = null;
  public $privilege = null;
  public $username = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'userId',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'shardId',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'privilege',
          'type' => TType::I32,
          ),
        4 => array(
          'var' => 'username',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['userId'])) {
        $this->userId = $vals['userId'];
      }
      if (isset($vals['shardId'])) {
        $this->shardId = $vals['shardId'];
      }
      if (isset($vals['privilege'])) {
        $this->privilege = $vals['privilege'];
      }
      if (isset($vals['username'])) {
        $this->username = $vals['username'];
      }
    }
  }

  public function getName() {
    return 'PublicUserInfo';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->userId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->shardId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->privilege);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->username);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PublicUserInfo');
    if ($this->userId !== null) {
      $xfer += $output->writeFieldBegin('userId', TType::I32, 1);
      $xfer += $output->writeI32($this->userId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->shardId !== null) {
      $xfer += $output->writeFieldBegin('shardId', TType::STRING, 2);
      $xfer += $output->writeString($this->shardId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->privilege !== null) {
      $xfer += $output->writeFieldBegin('privilege', TType::I32, 3);
      $xfer += $output->writeI32($this->privilege);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->username !== null) {
      $xfer += $output->writeFieldBegin('username', TType::STRING, 4);
      $xfer += $output->writeString($this->username);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class edam_userstore_PremiumInfo {
  static $_TSPEC;

  public $currentTime = null;
  public $premium = null;
  public $premiumRecurring = null;
  public $premiumExpirationDate = null;
  public $premiumExtendable = null;
  public $premiumPending = null;
  public $premiumCancellationPending = null;
  public $canPurchaseUploadAllowance = null;
  public $sponsoredGroupName = null;
  public $sponsoredGroupRole = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'currentTime',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'premium',
          'type' => TType::BOOL,
          ),
        3 => array(
          'var' => 'premiumRecurring',
          'type' => TType::BOOL,
          ),
        4 => array(
          'var' => 'premiumExpirationDate',
          'type' => TType::I64,
          ),
        5 => array(
          'var' => 'premiumExtendable',
          'type' => TType::BOOL,
          ),
        6 => array(
          'var' => 'premiumPending',
          'type' => TType::BOOL,
          ),
        7 => array(
          'var' => 'premiumCancellationPending',
          'type' => TType::BOOL,
          ),
        8 => array(
          'var' => 'canPurchaseUploadAllowance',
          'type' => TType::BOOL,
          ),
        9 => array(
          'var' => 'sponsoredGroupName',
          'type' => TType::STRING,
          ),
        10 => array(
          'var' => 'sponsoredGroupRole',
          'type' => TType::I32,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['currentTime'])) {
        $this->currentTime = $vals['currentTime'];
      }
      if (isset($vals['premium'])) {
        $this->premium = $vals['premium'];
      }
      if (isset($vals['premiumRecurring'])) {
        $this->premiumRecurring = $vals['premiumRecurring'];
      }
      if (isset($vals['premiumExpirationDate'])) {
        $this->premiumExpirationDate = $vals['premiumExpirationDate'];
      }
      if (isset($vals['premiumExtendable'])) {
        $this->premiumExtendable = $vals['premiumExtendable'];
      }
      if (isset($vals['premiumPending'])) {
        $this->premiumPending = $vals['premiumPending'];
      }
      if (isset($vals['premiumCancellationPending'])) {
        $this->premiumCancellationPending = $vals['premiumCancellationPending'];
      }
      if (isset($vals['canPurchaseUploadAllowance'])) {
        $this->canPurchaseUploadAllowance = $vals['canPurchaseUploadAllowance'];
      }
      if (isset($vals['sponsoredGroupName'])) {
        $this->sponsoredGroupName = $vals['sponsoredGroupName'];
      }
      if (isset($vals['sponsoredGroupRole'])) {
        $this->sponsoredGroupRole = $vals['sponsoredGroupRole'];
      }
    }
  }

  public function getName() {
    return 'PremiumInfo';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->currentTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->premium);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->premiumRecurring);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->premiumExpirationDate);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->premiumExtendable);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->premiumPending);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->premiumCancellationPending);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->canPurchaseUploadAllowance);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->sponsoredGroupName);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 10:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->sponsoredGroupRole);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PremiumInfo');
    if ($this->currentTime !== null) {
      $xfer += $output->writeFieldBegin('currentTime', TType::I64, 1);
      $xfer += $output->writeI64($this->currentTime);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->premium !== null) {
      $xfer += $output->writeFieldBegin('premium', TType::BOOL, 2);
      $xfer += $output->writeBool($this->premium);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->premiumRecurring !== null) {
      $xfer += $output->writeFieldBegin('premiumRecurring', TType::BOOL, 3);
      $xfer += $output->writeBool($this->premiumRecurring);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->premiumExpirationDate !== null) {
      $xfer += $output->writeFieldBegin('premiumExpirationDate', TType::I64, 4);
      $xfer += $output->writeI64($this->premiumExpirationDate);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->premiumExtendable !== null) {
      $xfer += $output->writeFieldBegin('premiumExtendable', TType::BOOL, 5);
      $xfer += $output->writeBool($this->premiumExtendable);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->premiumPending !== null) {
      $xfer += $output->writeFieldBegin('premiumPending', TType::BOOL, 6);
      $xfer += $output->writeBool($this->premiumPending);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->premiumCancellationPending !== null) {
      $xfer += $output->writeFieldBegin('premiumCancellationPending', TType::BOOL, 7);
      $xfer += $output->writeBool($this->premiumCancellationPending);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->canPurchaseUploadAllowance !== null) {
      $xfer += $output->writeFieldBegin('canPurchaseUploadAllowance', TType::BOOL, 8);
      $xfer += $output->writeBool($this->canPurchaseUploadAllowance);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->sponsoredGroupName !== null) {
      $xfer += $output->writeFieldBegin('sponsoredGroupName', TType::STRING, 9);
      $xfer += $output->writeString($this->sponsoredGroupName);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->sponsoredGroupRole !== null) {
      $xfer += $output->writeFieldBegin('sponsoredGroupRole', TType::I32, 10);
      $xfer += $output->writeI32($this->sponsoredGroupRole);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class edam_userstore_AuthenticationResult {
  static $_TSPEC;

  public $currentTime = null;
  public $authenticationToken = null;
  public $expiration = null;
  public $user = null;
  public $publicUserInfo = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'currentTime',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'authenticationToken',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'expiration',
          'type' => TType::I64,
          ),
        4 => array(
          'var' => 'user',
          'type' => TType::STRUCT,
          'class' => 'edam_type_User',
          ),
        5 => array(
          'var' => 'publicUserInfo',
          'type' => TType::STRUCT,
          'class' => 'edam_userstore_PublicUserInfo',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['currentTime'])) {
        $this->currentTime = $vals['currentTime'];
      }
      if (isset($vals['authenticationToken'])) {
        $this->authenticationToken = $vals['authenticationToken'];
      }
      if (isset($vals['expiration'])) {
        $this->expiration = $vals['expiration'];
      }
      if (isset($vals['user'])) {
        $this->user = $vals['user'];
      }
      if (isset($vals['publicUserInfo'])) {
        $this->publicUserInfo = $vals['publicUserInfo'];
      }
    }
  }

  public function getName() {
    return 'AuthenticationResult';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->currentTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->authenticationToken);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->expiration);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRUCT) {
            $this->user = new edam_type_User();
            $xfer += $this->user->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRUCT) {
            $this->publicUserInfo = new edam_userstore_PublicUserInfo();
            $xfer += $this->publicUserInfo->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('AuthenticationResult');
    if ($this->currentTime !== null) {
      $xfer += $output->writeFieldBegin('currentTime', TType::I64, 1);
      $xfer += $output->writeI64($this->currentTime);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->authenticationToken !== null) {
      $xfer += $output->writeFieldBegin('authenticationToken', TType::STRING, 2);
      $xfer += $output->writeString($this->authenticationToken);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->expiration !== null) {
      $xfer += $output->writeFieldBegin('expiration', TType::I64, 3);
      $xfer += $output->writeI64($this->expiration);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->user !== null) {
      if (!is_object($this->user)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('user', TType::STRUCT, 4);
      $xfer += $this->user->write($output);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->publicUserInfo !== null) {
      if (!is_object($this->publicUserInfo)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('publicUserInfo', TType::STRUCT, 5);
      $xfer += $this->publicUserInfo->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

?>
