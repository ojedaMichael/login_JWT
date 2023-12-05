

import Data from "./dashboard/data"
import {PlusIcon} from "./dashboard/PlusIcon";
import {VerticalDotsIcon} from "./dashboard/VerticalDotsIcon";
import {SearchIcon} from "./dashboard/SearchIcon";
import {ChevronDownIcon} from "./dashboard/ChevronDownIcon";
import { capitalize } from "./dashboard/utils";
import {
  Select, SelectItem, Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button, useDisclosure, Checkbox, Input, Link,Table, TableHeader,TableColumn,TableBody,TableRow,TableCell,DropdownTrigger,Dropdown,DropdownMenu,DropdownItem,Chip,User,Pagination,
} from "@nextui-org/react";
import { useCallback, useEffect, useMemo, useState } from "react";
import axiosinstance from '../services/AxiosInstance';
import { LuLogOut } from "react-icons/lu";
import { useNavigate } from "react-router";

const INITIAL_VISIBLE_COLUMNS = ["name", "role", "status", "actions"];


function Dashboard() {
  const navigate = useNavigate();
  useEffect(() => {
    const token = localStorage.getItem('token');

    if (!token) {
     
      console.error('no existe un token');
     
      navigate('/');
      
    }
  },[navigate])
  const {isOpen, onOpen: openModal, onOpenChange} = useDisclosure();
  const [modalType, setModalType] = useState(null);
  const {  columns,  } = Data()
  const [filterValue, setFilterValue] = useState("");
  const [selectedKeys, setSelectedKeys] = useState(new Set([]));
  const [visibleColumns, setVisibleColumns] = useState(new Set(INITIAL_VISIBLE_COLUMNS));
  const [id, setId] = useState("");
  const [rowsPerPage, setRowsPerPage] = useState(5);
  const [numero, setNumero] = useState("");
  const [updateTable, setUpdateTable] = useState(true);
  const [sortDescriptor, setSortDescriptor] = useState({

    column: "age",
    direction: "ascending",
  });

  const [formRegister, setFormRegister] = useState({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  const [formEdit, setFormEdit] = useState({
    name: '',
    email: '',
    password: '',
    habilitado: '',
  });
  
  const handleLogout = () => {
    localStorage.removeItem('token');
    navigate('/');
  };

  
  const changeEdit = (e) => {
    const { name, value } = e.target;
    setFormEdit({
      ...formEdit,
      [name]: value,
    });
  };

  const changeRegister = (e) => {
    const { name, value } = e.target;
    setFormRegister({
      ...formRegister,
      [name]: value,
    });
  };

  const handleDelete = (e) => {
    const number = e.target.value;
    setNumero(number);
  };

  const handleClick = (e) => {
    const number = e.target.value;

    setId(number);
  };




  const onOpen = (type) => {
    setModalType(type);
    openModal(true);
  };
  
  const onClose = () => {
    setModalType(null);
    openModal(false);
  };
  
  

  const [users, setUsers] = useState([]);
  useEffect(() => {
      const fetchData = async () => {
        try {
          const response = await axiosinstance.get("users");
          setUsers(response.data.usuarios);
          setUpdateTable(false);
        } catch (error) {
          console.error("Error al obtener datos de la API", error);
        }
      };
      fetchData();
    }, [updateTable]);
  useEffect(() => {
    const getDataId = async () => {
      try {
        const response = await axiosinstance.get(`users/${id}`);

        
        setFormEdit({
          name: response.data?.name || "",
          email: response.data?.email || "",
          password: response.data?.password || "",
          habilitado: response.data?.habilitado || "",
        });
      } catch (error) {
        console.error("Error al obtener datos de la API para editar", error);
      }
    };
    getDataId();
  }, [id]);

  useEffect(() => {
    const deleteData = async () => {
      try {
        const response = await axiosinstance.delete(`users/${numero}`);
        alert(response.data);
        setUpdateTable(true);
      } catch (error) {
        console.error("Error al borrar de la API", error);
      }
    };
    deleteData();
  }, [numero]);

  const handleEdit = async (e) => {
    e.preventDefault();

    try {
      const response = await axiosinstance.put(`users/${id}`, formEdit);

      setUpdateTable(true);
      
     
    } catch (error) {
      console.error("error al enviar solicitud:", error);
    }
  };


  const handleRegister = async (e) => {
    e.preventDefault();
    try {
      const response = await axiosinstance.post("auth/register",formRegister);
      
      setUpdateTable(true);
    } catch (error) {
        console.error('error al enviar solicitud:', error)
    }
  }
  

  const [page, setPage] = useState(1);

  const hasSearchFilter = Boolean(filterValue);

  const headerColumns = useMemo(() => {
    if (visibleColumns === "all") return columns;

    return columns.filter((column) => Array.from(visibleColumns).includes(column.uid));
  }, [visibleColumns]);

  const filteredItems = useMemo(() => {
    let filteredUsers = [...users];

    if (hasSearchFilter) {
      filteredUsers = filteredUsers.filter((user) =>
        user.name.toLowerCase().includes(filterValue.toLowerCase()),
      );
    }
    

    return filteredUsers;
  }, [users, filterValue,]);

  const pages = Math.ceil(filteredItems.length / rowsPerPage);

  const habilitado = [{label:"Habilitado", id: "1"},{label:"Inhabilitado", id: "0"} ]

  const items = useMemo(() => {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    return filteredItems.slice(start, end);
  }, [page, filteredItems, rowsPerPage]);

  const sortedItems = useMemo(() => {
    return [...items].sort((a, b) => {
      const first = a[sortDescriptor.column];
      const second = b[sortDescriptor.column];
      const cmp = first < second ? -1 : first > second ? 1 : 0;

      return sortDescriptor.direction === "descending" ? -cmp : cmp;
    });
  }, [sortDescriptor, items]);

  const renderCell = useCallback((user, columnKey) => {
    const cellValue = user[columnKey];

    switch (columnKey) {
      case "name":
        return (
          <User
            name={cellValue}
          >

          </User>
        );
      case "email":
        return (
          <div className="flex flex-col">
            <p className="text-bold text-small capitalize">{cellValue}</p>
           
          </div>
        );
      case "fecha":
        return (
          <div className="flex flex-col">
            <p className="text-bold text-small capitalize">{cellValue}</p>
           
          </div>
        );
      case "habilitado":
       
        return (
         
          <Chip className="capitalize" color={cellValue === "1"?"success":"danger"} size="sm" variant="faded">
           {cellValue === "1"?"habilitado":"inhabilitado"}
          </Chip>
        );
      case "actions":

  return (
    <div className="relative flex justify-end items-center gap-2">
    <Dropdown>
      <DropdownTrigger>
        <Button isIconOnly size="sm" variant="light">
          <VerticalDotsIcon className="text-default-300" />
        </Button>
      </DropdownTrigger>
      <DropdownMenu>
        <DropdownItem key={"edit"} value={user.id} onPress={(e) => [onOpen("edit"), handleClick(e)]}>Edit</DropdownItem>
        <DropdownItem onPress={handleDelete} value={user.id} className="text-danger" color="danger">Delete</DropdownItem>
      </DropdownMenu>
    </Dropdown>
  </div>
);
default:
return cellValue;
}
}, [onOpen]);

const onNextPage = useCallback(() => {
  if (page < pages) {
    setPage(page + 1);
  }
}, [page, pages]);

const onPreviousPage = useCallback(() => {
  if (page > 1) {
    setPage(page - 1);
  }
}, [page]);

const onRowsPerPageChangeCallback = useCallback((e) => {
  setRowsPerPage(Number(e.target.value));
  setPage(1);
}, []);

const onSearchChange = useCallback((value) => {
if (value) {
setFilterValue(value);
setPage(1);
} else {
setFilterValue("");
}
}, []);

const onClear = useCallback(()=>{
setFilterValue("")
setPage(1)
},[])

const topContent = useMemo(() => {
return (
<div className="flex flex-col gap-4">
<div className="flex justify-between gap-3 items-end">
  <Input
    isClearable
    className="w-full sm:max-w-[44%]"
    placeholder="Search by name..."
    startContent={<SearchIcon />}
    value={filterValue}
    onClear={() => onClear()}
    onValueChange={onSearchChange}
  />
  <div className="flex gap-3">
    <Dropdown>
      <DropdownTrigger className="hidden sm:flex">
        <Button endContent={<ChevronDownIcon className="text-small" />} variant="flat">
          Columns
        </Button>
      </DropdownTrigger>
      <DropdownMenu
        disallowEmptySelection
        aria-label="Table Columns"
        closeOnSelect={false}
        selectedKeys={visibleColumns}
        selectionMode="multiple"
        onSelectionChange={setVisibleColumns}
      >
        {columns.map((column) => (
          <DropdownItem key={column.uid} className="capitalize">
            {capitalize(column.name)}
          </DropdownItem>
        ))}
      </DropdownMenu>
    </Dropdown>
    <Button key={"add"} onPress={() => onOpen("add")} color="primary" endContent={<PlusIcon />}>
      Add New
    </Button>
    <Button key={"add"} onPress={() => handleLogout()} variant="faded" color="danger" endContent={<LuLogOut />}>
      LogOut
    </Button>
  </div>
</div>
<div className="flex justify-between items-center">
  <span className="text-default-400 text-small">Total {users.length} users</span>
  <label className="flex items-center text-default-400 text-small">
    Rows per page:
    <select
      className="bg-transparent outline-none text-default-400 text-small"
      onChange={onRowsPerPageChangeCallback}
    >
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="15">15</option>
    </select>
  </label>
</div>
</div>
);
}, [
filterValue,
visibleColumns,
onRowsPerPageChangeCallback,
users.length,
onSearchChange,
hasSearchFilter,
]);

const bottomContent = useMemo(() => {
return (
<div className="py-2 px-2 flex justify-between items-center">
<span className="w-[30%] text-small text-default-400">
  {selectedKeys === "all"
    ? "All items selected"
    : `${selectedKeys.size} of ${filteredItems.length} selected`}
</span>
<Pagination
  isCompact
  showControls
  showShadow
  color="primary"
  page={page}
  total={pages}
  onChange={setPage}
/>
<div className="hidden sm:flex w-[30%] justify-end gap-2">
  <Button isDisabled={pages === 1} size="sm" variant="flat" onPress={onPreviousPage}>
    Previous
  </Button>
  <Button isDisabled={pages === 1} size="sm" variant="flat" onPress={onNextPage}>
    Next
  </Button>
</div>
</div>
);
}, [selectedKeys, items.length, page, pages, hasSearchFilter]);

return (
  <>
    <div className="h-screen">
      <Table
        aria-label="Example table with custom cells, pagination and sorting"
        isHeaderSticky
        bottomContent={bottomContent}
        bottomContentPlacement="outside"
        classNames={{
          wrapper: "max-h-[382px]",
        }}
        selectedKeys={selectedKeys}
        selectionMode="multiple"
        sortDescriptor={sortDescriptor}
        topContent={topContent}
        topContentPlacement="outside"
        onSelectionChange={setSelectedKeys}
        onSortChange={setSortDescriptor}
      >
        <TableHeader columns={headerColumns}>
          {(column) => (
            <TableColumn
              key={column.uid}
              align={column.uid === "actions" ? "center" : "start"}
              allowsSorting={column.sortable}
            >
              {column.name}
            </TableColumn>
          )}
        </TableHeader>
        <TableBody emptyContent={"No users found"} items={sortedItems}>
          {(item) => (
            <TableRow key={item.id}>
              {(columnKey) => (
                <TableCell>{renderCell(item, columnKey)}</TableCell>
              )}
            </TableRow>
          )}
        </TableBody>
      </Table>
    </div>
    <Modal
      key={modalType}
      isOpen={isOpen}
      onOpenChange={onOpenChange}
      placement="top-center"
    >
      <ModalContent>
        {(onClose) => (
          <>
            <ModalHeader className="flex flex-col gap-1">
              {modalType === "edit" ? "Edit User" : "Add User"}
            </ModalHeader>
            <ModalBody>
              {modalType === "edit" ? (
                <form onSubmit={handleEdit} className="flex flex-col gap-4 h-[350px]">
                  <Input
                    name="name"
                    id="name"
                    isRequired
                    label="Name"
                    placeholder="Enter your name"
                    type="text"
                    value={formEdit.name}
                    onChange={changeEdit}
                  />
                  <Input
                    name="email"
                    id="email"
                    value={formEdit.email}
                    isRequired
                    label="Email"
                    placeholder="Enter your email"
                    type="email"
                    onChange={changeEdit}
                  />
                  <Input
                    name="password"
                    id="password"
                    value={formEdit.password}
                    isRequired
                    label="Password"
                    placeholder="Enter your password"
                    type="password"
                    onChange={changeEdit}
                  />
                  
                  <Select name="habilitado" id="habilitado" onChange={changeEdit} label="Selecciona una opcion" >
                    {habilitado.map((h) => (
                      <SelectItem key={h.id} value={h.id}>
                        {h.label}
                      </SelectItem>
                    ))}
                  </Select>
                 
                  <ModalFooter>
                    <Button color="danger" variant="flat" onPress={onClose}>
                      Close
                    </Button>
                    <Button type="submit" color="primary" onPress={onClose}>
                      Edit
                    </Button>
                  </ModalFooter>
                </form>
              ) : (
                <form
                  onSubmit={handleRegister}
                  className="flex flex-col gap-4 h-[350px]"
                >
                  <Input
                    name="name"
                    id="name"
                    isRequired
                    label="Name"
                    placeholder="Enter your name"
                    type="text"
                    value={formRegister.name}
                    onChange={changeRegister}
                  />
                  <Input
                    name="email"
                    id="email"
                    value={formRegister.email}
                    isRequired
                    label="Email"
                    placeholder="Enter your email"
                    type="email"
                    onChange={changeRegister}
                  />
                  <Input
                    name="password"
                    id="password"
                    value={formRegister.password}
                    isRequired
                    label="Password"
                    placeholder="Enter your password"
                    type="password"
                    onChange={changeRegister}
                  />
                  <Input
                    name="password_confirmation"
                    id="password_confirmation"
                    value={formRegister.password_confirmation}
                    isRequired
                    label="Confirm your password"
                    placeholder="Confirm your password"
                    type="password"
                    onChange={changeRegister}
                  />

                  <ModalFooter>
                    <Button color="danger" variant="flat" onPress={onClose}>
                      Close
                    </Button>
                    <Button type="submit" color="primary" onPress={onClose}>
                      Add
                    </Button>
                  </ModalFooter>
                </form>
              )}
            </ModalBody>
          </>
        )}
      </ModalContent>
    </Modal>
  </>
);
}

export default Dashboard