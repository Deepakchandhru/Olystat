-- Trigger function

Create or replace function log()
returns trigger
language plpgsql
as $$

Begin
If new.status='signed out' AND OLD.status IS DISTINCT FROM NEW.status then
   Update login
   Set lastseen=current_timestamp
   where uname=new.uname;
Elsif new.status='signed in' AND OLD.status IS DISTINCT FROM NEW.status then
   Update login
   Set lastseen=NULL
   where uname=new.uname;
End if;
return new;
End $$;

Create or replace trigger lasttime
after update on login
for each row execute procedure log();