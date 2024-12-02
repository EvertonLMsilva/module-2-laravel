<?php

namespace App\Enum;

enum TransactionStatus: int
{
  case PAID = 1;
  case PAIDING = 2;
  case FAILED = 3;
  case CANCELED = 0;
}
