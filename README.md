# slotegrator-assignment

## Installation

```bash
console/install dev
```

## Destroy (delete volumes and reinstall)
```bash
console/destroy
console/install dev
```

## Run containers
```bash
console/up
```

## Stop containers
```bash
console/down
```

## Connect to php container
```bash
console/cli
console/cli php backend/console/console.php payments:process 10
```



## Preparation todos
- [X] Prepare docker for two environments: dev and test
- [X] Decide which libraries to use
- [X] Decide architectural approach and directory structures
- [X] Prepare bootstrap


## Development todos
- [X] Sign up
- [X] Authentication
- [X] Gift
- [X] Money
- [X] Bonus
- [X] Get random
- [X] Send money to users bank accounts
- [ ] Unit Tests (only raffle and only stubs without fakers)
- [X] Seeders and install command
- [ ] Load testing and fakers

- [ ] wrap with transaction, foreign keys (didn't have enough time to do it unfortunately)
- [ ] Frontend (we have REST api and postman collection to test)
- [ ] Add money to programms balance (dont have enough time to do it, instead money will be added to programms balance via seeders)
- [ ] code sniffer and phpstan (dont have enough time to do it)

## Libraries
- [X] router
- [X] config
- [X] container
- [X] orm
- [X] migration
- [X] validation




users
- id
- email
- password
- created_at
- updated_at

requisites
- id
- user_id
- data (json)

gifts
- id
- name
- balance
- created_at
- updated_at

gift_transactions
- id
- gift_id
- raffle_id
- amount
- gift_balance
- created_at
- updated_at

raffles
- id
- user_id
- type
- gift_id
- gift_name
- gift_amount
- money_amount
- money_transaction_id
- bonus_amount
- created_at
- updated_at

money_transactions
- id
- ?user_id
- amount
- balance
- created_at
- updated_at

bonus_transactions
- id
- user_id
- amount
- balance
- created_at
- updated_at
