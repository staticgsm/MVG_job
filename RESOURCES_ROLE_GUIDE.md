# How to Use and Assign User Roles

This guide explains how to manage user roles within the system, specifically for Admin, HR, and Accountant positions.

## 1. Assigning a Role to a User

To add a new staff member or change an existing user's role:

### Adding a New User
1. Navigate to **Administration > Users** in the sidebar.
2. Click the **[+] Add New User** button.
3. Fill in the user's details (Name, Email, Password).
4. In the **Assign Role** dropdown, select the target role:
   - **Admin**: For full system maintenance and job management.
   - **HR**: For recruitment specifically (reviewing applications, shortlisting).
   - **Accountant**: For financial monitoring and revenue reports.
5. Ensure the "Active Account" checkbox is checked and click **Create User Account**.

### Changing an Existing User
1. Find the user in the **Users** list.
2. Click the **Edit (Pencil)** icon.
3. Update the **Assign Role** dropdown to the new role.
4. Save the changes.

## 2. Platform Access Points

Once assigned, users can access their specialized dashboards by logging in:

- **HR Staff**: Will be automatically directed to the **HR Command Center** at `/hr/dashboard`.
- **Accountants**: Will be automatically directed to the **Financial Overview** at `/accountant/dashboard`.
- **Admins**: Will be directed to the **General Admin Dashboard** at `/admin/dashboard`.

## 3. Managing Role Permissions

If you need to fine-tune what an HR or Accountant can do:
1. Go to **Administration > Roles** in the sidebar.
2. Click the **Key (Permissions)** icon next to the "HR" or "Accountant" role.
3. Check or uncheck the specific permissions (e.g., `job.create`, `payment.view`).
4. Save the permissions matrix.

> [!NOTE]
> Only Super Admins have the ability to modify global permissions and roles.
