import {Link} from 'react-router-dom'


export default function ProductCard({ data }) {
    if (data !== undefined) {
        return (
            <div className="flex items-start max-w-xs rounded-lg border dark:border-gray-200 overflow-hidden mb-6">
                <Link className="flex-1" to={"/p/" + data.id}>
                    <img
                        alt={data.title}
                        className="object-cover w-full aspect-square"
                        src={data.pictures[0].picture_link}
                    />
                    <div className="p-4 relative md">
                        <div className="font-bold line-clamp-2">{data.title}</div>
                        <div className="text-2xl font-bold bottom-0">{data.selling_price}€</div>
                    </div>
                </Link>
            </div>
        )
    }
}